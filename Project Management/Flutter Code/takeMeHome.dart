import 'dart:async';
import 'dart:convert';
import 'dart:math';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';
import 'package:amin_bisa/route_list.dart';

import 'package:flutter/material.dart';
import 'package:flutter/src/widgets/container.dart';
import 'package:flutter/src/widgets/framework.dart';
import 'package:flutter_polyline_points/flutter_polyline_points.dart';
import 'package:geolocator/geolocator.dart';
import 'package:google_maps_flutter/google_maps_flutter.dart';
import 'package:location/location.dart';

import '../location_service.dart';

class takeMehome extends StatefulWidget {
  const takeMehome({super.key});

  @override
  State<takeMehome> createState() => _takeMehomeState();
}

class _takeMehomeState extends State<takeMehome> {
  Completer<GoogleMapController> _controller = Completer();

  //TEXT EDITING CONTROLLER
  TextEditingController _originController = TextEditingController();
  final preFilledOrigin = 'Your location'; //PRE FILL ORIGIN LOCATION
  final preFilledDestination = 'Home';
  TextEditingController _destinationController = TextEditingController();

  // Set<Marker> _markers = Set<Marker>();
  Map<MarkerId, Marker> _markers =
      <MarkerId, Marker>{}; // CLASS MEMBER, MAP OF MARKS
  Set<Polygon> _polygons = Set<Polygon>();
  List<LatLng> polygonLatLngs = <LatLng>[];
  Set<Polyline> _polylines = Set<Polyline>();
  LocationData? currentLocation;

  int _polygonIdCounter = 1;
  int _polylineIdCounter = 1;

  //SAVE CURRENT POSITION
  static double curLat = 0;
  static double curLng = 0;

  static String jarak = 'ini jarak';
  static String waktuTempuh = 'ini waktu';

  static double destLat = -7.289419;
  static double destLng = 112.676313;
  // static double destLat = -7.272217;
  // static double destLng = 112.756301;

  get async => null;

  //GET CURRENT POSITION
  getCurrentLoc() async {
    Location location = Location();
    location.getLocation().then((location) {
      currentLocation = location;
    });
    Position position = await _determinePosition();

    curLat = position.latitude;
    curLng = position.longitude;

    if (currentLocation == null) {
    } else {
      _setMarker(
          LatLng(currentLocation!.latitude!, currentLocation!.longitude!), "0");
    }
  }

  static final CameraPosition camPosition = CameraPosition(
    target: LatLng(curLat, curLng),
    zoom: 15,
  );

  @override
  void initState() {
    super.initState();
    getCurrentLoc();
    _originController.text = preFilledOrigin;
    _destinationController.text = preFilledDestination;
  }

  void _setMarker(LatLng point, String angka) {
    var markerIdVal = angka;
    final MarkerId markerId = MarkerId(markerIdVal);
    final Marker marker = Marker(
      markerId: markerId,
      position: point,
    );
    setState(() {
      _markers[markerId] = marker;
    });
  }

  void _setPolygon() {
    final String polygonIdVal = 'polygon_$_polygonIdCounter';
    _polygonIdCounter++;

    _polygons.add(Polygon(
      polygonId: PolygonId(polygonIdVal),
      points: polygonLatLngs,
      strokeWidth: 2,
      fillColor: Colors.transparent,
    ));
  }

  void _setPolyline(List<PointLatLng> points, counter, {String mode = "beda"}) {
    // final String polyLineIdVal = 'polyline_$_polylineIdCounter';
    // final String polyLineIdVal = 'polyline';
    // var hasil= ["#e74c3c", "#3498db", "#2ecc71", "#9b59b6", "#f1c40f"];
    print("modenya adalah : " + mode);
    _polylineIdCounter++;
    if (mode == 'WALKING') {
      _polylines.add(Polyline(
        polylineId: PolylineId(counter),
        width: 6,
        patterns: <PatternItem>[PatternItem.dot, PatternItem.gap(10)],
        color: Colors.blue,
        points: points
            .map(
              (point) => LatLng(point.latitude, point.longitude),
            )
            .toList(),
      ));
    } else if (mode == 'TRANSIT') {
      // Color color = Color.fromHex("#e74c3c");
      var jawab = int.parse(counter) % 5;
      switch (jawab) {
        case 1:
          _polylines.add(Polyline(
            polylineId: PolylineId(counter),
            width: 4,
            color: Colors.redAccent[700]!,
            points: points
                .map(
                  (point) => LatLng(point.latitude, point.longitude),
                )
                .toList(),
          ));
          break;
        case 2:
          _polylines.add(Polyline(
            polylineId: PolylineId(counter),
            width: 4,
            color: Colors.yellowAccent[700]!,
            points: points
                .map(
                  (point) => LatLng(point.latitude, point.longitude),
                )
                .toList(),
          ));
          break;
        case 3:
          _polylines.add(Polyline(
            polylineId: PolylineId(counter),
            width: 4,
            color: Colors.green[600]!,
            points: points
                .map(
                  (point) => LatLng(point.latitude, point.longitude),
                )
                .toList(),
          ));
          break;
        case 4:
          _polylines.add(Polyline(
            polylineId: PolylineId(counter),
            width: 4,
            color: Colors.deepPurple[800]!,
            points: points
                .map(
                  (point) => LatLng(point.latitude, point.longitude),
                )
                .toList(),
          ));
          break;
        case 0:
          _polylines.add(Polyline(
            polylineId: PolylineId(counter),
            width: 4,
            color: Colors.blueGrey[600]!,
            points: points
                .map(
                  (point) => LatLng(point.latitude, point.longitude),
                )
                .toList(),
          ));
          break;
      }
    } else {
      _polylines.add(Polyline(
        polylineId: PolylineId(counter),
        width: 4,
        color: Colors.black,
        points: points
            .map(
              (point) => LatLng(point.latitude, point.longitude),
            )
            .toList(),
      ));
    }
    ;
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        appBar: AppBar(
          elevation: 5,
          backgroundColor: Color.fromRGBO(62, 193, 211, 1),
          title: Text(
            "Transtreet",
            style: TextStyle(
                fontFamily: "Sriracha",
                fontSize: 26,
                color: Color.fromRGBO(246, 247, 215, 1)),
          ),
        ),
        body: currentLocation == null
            ? const Center(
                child: Text("Loading...",
                    style: TextStyle(fontFamily: "Comfortaa")))
            : Stack(children: [
                Expanded(
                  child: GoogleMap(
                    mapType: MapType.normal,
                    markers:
                        Set<Marker>.of(_markers.values), // YOUR MARKS IN MAP,
                    polylines: _polylines,
                    initialCameraPosition: camPosition,
                    myLocationEnabled: true,
                    onMapCreated: (GoogleMapController controller) {
                      _controller.complete(controller);
                    },
                    onTap: (point) {
                      setState(() {
                        polygonLatLngs.add(point);
                        _setPolygon();
                      });
                    },
                  ),
                ),
                show_list_transportasi(_listTransportasi, _showList),
                showRoute(_showRute),
                showSteps1(_showsteps1),
                showSteps2(_showsteps2),
                showSteps3(_showsteps3),
                Padding(
                  padding: const EdgeInsets.all(7),
                  child: Container(
                    height: 106,
                    decoration: BoxDecoration(
                        color: Color.fromRGBO(246, 247, 215, 1),
                        borderRadius: BorderRadius.circular(14)),
                    child: Row(
                      children: [
                        Expanded(
                          child: Column(
                            children: <Widget>[
                              TextFormField(
                                // enabled: false,
                                controller: _originController,
                                maxLines: 1,
                                decoration: InputDecoration(
                                  contentPadding: const EdgeInsets.all(16),
                                  border: InputBorder.none,
                                  hintText: 'Your location',
                                ),
                                onChanged: (value) {
                                  print(value);
                                },
                              ),
                              TextFormField(
                                enabled: false,
                                controller: _destinationController,
                                maxLines: 1,
                                decoration: InputDecoration(
                                  contentPadding: const EdgeInsets.all(16),
                                  border: InputBorder.none,
                                  hintText: 'Home',
                                ),
                                onChanged: (value) {
                                  print(value);
                                },
                              ),
                            ],
                          ),
                        ),
                      ],
                    ),
                  ),
                ),
              ]));
  }

  Future refresh2_1() async {
    setState(() {
      _showsteps1 = 0;
    });
  }

  Future refresh2_2() async {
    setState(() {
      _showsteps2 = 0;
    });
  }

  Future refresh2_3() async {
    setState(() {
      _showsteps3 = 0;
    });
  }

  Future refresh3() async {
    setState(() {
      _showList = 0;
    });
  }

  int _showList = 0;
  List _listTransportasi = ["Bis 1", "Bis 2", "Bis 3", "Bis 4", "Bis 5"];
  List<String> _listInstruksi = [
    "Instruksi 1",
    "Instruksi 2",
    "Instruksi 3",
    "Instruksi 4",
    "Instruksi 5"
  ];
  List<String> _listPilihIcon = ["dummy", "dummy", "dummy", "dummy", "dummy"];
  List<String> _listPilihIconWithChevron = [
    "dummy",
    "dummy",
    "dummy",
    "dummy",
    "dummy"
  ];
  List<String> _listWaktuTempuhPerTransport = ["0", "0", "0", "0", "0"];
  List<String> _listInfo = ["waktu berangkat", "waktu sampai", "durasi"];

  Widget show_list_transportasi(List _listTransportasi, int _showList) {
    if (_showList == 1) {
      return DraggableScrollableSheet(
          initialChildSize: 0.23,
          minChildSize: 0.23,
          maxChildSize: 0.523,
          builder: (BuildContext context, ScrollController scrollController) {
            return SingleChildScrollView(
              controller: scrollController,
              child: Card(
                elevation: 12.0,
                shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.only(
                        topLeft: Radius.circular(24),
                        topRight: Radius.circular(24))),
                margin: const EdgeInsets.all(0),
                child: Container(
                    height: 400,
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.only(
                          topLeft: Radius.circular(24),
                          topRight: Radius.circular(24)),
                    ),
                    child: Column(
                      children: [
                        SizedBox(height: 12),
                        Container(
                          height: 5,
                          width: 30,
                          decoration: BoxDecoration(
                              color: Colors.grey[200],
                              borderRadius: BorderRadius.circular(16)),
                        ),
                        Padding(
                          padding: EdgeInsets.all(16),
                        ),
                        Expanded(
                          child: ListView.builder(
                            itemCount: _listTransportasi.length,
                            itemBuilder: (_, i) => ListTile(
                              title: InkWell(
                                borderRadius: BorderRadius.circular(16),
                                child: Container(
                                  height: 102,
                                  width:
                                      MediaQuery.of(context).size.width * 0.9,
                                  padding: EdgeInsets.all(15),
                                  decoration: BoxDecoration(
                                      borderRadius: BorderRadius.circular(16),
                                      color: Color.fromRGBO(255, 22, 93, 1)),
                                  child: Expanded(
                                    child: Row(
                                      mainAxisAlignment:
                                          MainAxisAlignment.start,
                                      children: [
                                        Expanded(
                                          child: Column(
                                            crossAxisAlignment:
                                                CrossAxisAlignment.start,
                                            children: [
                                              Row(
                                                  mainAxisAlignment:
                                                      MainAxisAlignment
                                                          .spaceBetween,
                                                  children: [
                                                    Row(
                                                      children: [
                                                        Container(
                                                          height: 20,
                                                          child: Image.asset(
                                                            'lib/icons/${_listPilihIcon[i]}.png',
                                                            color: Colors.white,
                                                          ),
                                                        ),
                                                        SizedBox(
                                                          width: 10,
                                                        ),
                                                        Text(
                                                          "${_listTransportasi[i]}",
                                                          style: TextStyle(
                                                            fontSize: 14,
                                                            fontWeight:
                                                                FontWeight.bold,
                                                            color:
                                                                Color.fromRGBO(
                                                                    246,
                                                                    247,
                                                                    215,
                                                                    1),
                                                          ),
                                                          softWrap: true,
                                                          maxLines: 3,
                                                          overflow: TextOverflow
                                                              .fade, //new
                                                        ),
                                                      ],
                                                    ),
                                                  ]),
                                            ],
                                          ),
                                        ),
                                      ],
                                    ),
                                  ),
                                ),
                              ),
                            ),
                          ),
                        ),
                        SizedBox(
                          height: 20,
                        )
                      ],
                    )),
              ),
            );
          });
    }
    return Container();
  }

  //3 widget di bawah buat show list icon nya tok

  // button transport transit
  int _showsteps1 = 0;
  Widget showSteps1(int _showsteps1) {
    if (_showsteps1 == 1) {
      return DraggableScrollableSheet(
          initialChildSize: 0.184,
          minChildSize: 0.184,
          maxChildSize: 0.184,
          builder: (BuildContext context, ScrollController scrollController) {
            return SingleChildScrollView(
                controller: scrollController,
                child: Card(
                    elevation: 12.0,
                    shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.only(
                            topLeft: Radius.circular(24),
                            topRight: Radius.circular(24))),
                    margin: const EdgeInsets.all(0),
                    child: Container(
                        height: 141,
                        decoration: BoxDecoration(
                          borderRadius: BorderRadius.only(
                              topLeft: Radius.circular(24),
                              topRight: Radius.circular(24)),
                        ),
                        child: Container(
                            height: 95,
                            width: MediaQuery.of(context).size.width * 0.9,
                            padding: EdgeInsets.all(15),
                            // ignore: prefer_const_constructors
                            decoration: BoxDecoration(
                                borderRadius: const BorderRadius.only(
                                    topRight: Radius.circular(16),
                                    topLeft: Radius.circular(16)),
                                color: Color.fromRGBO(246, 247, 215, 1)),
                            child: Expanded(
                                child: Row(
                                    mainAxisAlignment: MainAxisAlignment.start,
                                    children: [
                                  Expanded(
                                    flex: 7,
                                    child: Column(
                                      crossAxisAlignment:
                                          CrossAxisAlignment.start,
                                      children: [
                                        Align(
                                            alignment: FractionalOffset.topLeft,
                                            child: Row(
                                              mainAxisAlignment:
                                                  MainAxisAlignment
                                                      .spaceBetween,
                                              children: [
                                                Row(
                                                  children: [
                                                    Padding(
                                                      padding: EdgeInsets.only(
                                                          right: 7),
                                                      child: Container(
                                                        height: 24,
                                                        child: Image.asset(
                                                            'lib/icons/bus.png',
                                                            color:
                                                                Colors.black87),
                                                      ),
                                                    ),
                                                    Text(
                                                      "${_listInfo[0]} - ${_listInfo[1]}",
                                                      style: TextStyle(
                                                        fontSize: 14,
                                                        fontWeight:
                                                            FontWeight.bold,
                                                        color: Colors.black87,
                                                      ),
                                                      softWrap: true,
                                                      maxLines: 3,
                                                      overflow: TextOverflow
                                                          .fade, //new
                                                    ),
                                                  ],
                                                ),
                                                Text(
                                                  "${_listInfo[2]}",
                                                  style: TextStyle(
                                                    fontSize: 14,
                                                    fontWeight: FontWeight.bold,
                                                    color: Colors.black87,
                                                  ),
                                                  softWrap: true,
                                                  maxLines: 3,
                                                  overflow:
                                                      TextOverflow.fade, //new
                                                ),
                                              ],
                                            )),
                                        SizedBox(height: 15),
                                        Expanded(
                                          child: ListView.builder(
                                              scrollDirection: Axis.horizontal,
                                              shrinkWrap: true,
                                              itemCount:
                                                  _listPilihIconWithChevron
                                                          .length -
                                                      1,
                                              itemBuilder: (_, i) => Expanded(
                                                    child:
                                                        _listPilihIconWithChevron[
                                                                    i] ==
                                                                "next"
                                                            ? Container(
                                                                height: 15,
                                                                child:
                                                                    Image.asset(
                                                                  'lib/icons/${_listPilihIconWithChevron[i]}.png',
                                                                  color: Colors
                                                                      .black45,
                                                                ),
                                                              )
                                                            : Container(
                                                                height: 20,
                                                                child:
                                                                    Image.asset(
                                                                  'lib/icons/${_listPilihIconWithChevron[i]}.png',
                                                                  color: Colors
                                                                      .black,
                                                                ),
                                                              ),
                                                  )),
                                        ),
                                        SizedBox(
                                          height: 10,
                                        ),
                                        SizedBox(
                                            height: 30,
                                            child: TextButton(
                                                onPressed: () {
                                                  setState(() {
                                                    _showList = 1;
                                                    refresh2_1();
                                                  });
                                                },
                                                child: Text(
                                                  "Details",
                                                  style: TextStyle(
                                                    fontSize: 14,
                                                    fontWeight: FontWeight.bold,
                                                    color: Color.fromRGBO(
                                                        255, 22, 93, 1),
                                                  ),
                                                )))
                                      ],
                                    ),
                                  ),
                                ]))))));
          });
    } else {
      return Container();
    }
  }

  //button transport bemo
  int _showsteps2 = 0;
  Widget showSteps2(int _showsteps2) {
    if (_showsteps2 == 1) {
      return DraggableScrollableSheet(
          initialChildSize: 0.184,
          minChildSize: 0.184,
          maxChildSize: 0.184,
          builder: (BuildContext context, ScrollController scrollController) {
            return SingleChildScrollView(
                controller: scrollController,
                child: Card(
                    elevation: 12.0,
                    shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.only(
                            topLeft: Radius.circular(24),
                            topRight: Radius.circular(24))),
                    margin: const EdgeInsets.all(0),
                    child: Container(
                        height: 141,
                        decoration: BoxDecoration(
                          borderRadius: BorderRadius.only(
                              topLeft: Radius.circular(24),
                              topRight: Radius.circular(24)),
                        ),
                        child: Container(
                            height: 95,
                            width: MediaQuery.of(context).size.width * 0.9,
                            padding: EdgeInsets.all(15),
                            // ignore: prefer_const_constructors
                            decoration: BoxDecoration(
                                borderRadius: const BorderRadius.only(
                                    topRight: Radius.circular(16),
                                    topLeft: Radius.circular(16)),
                                color: Color.fromRGBO(246, 247, 215, 1)),
                            child: Expanded(
                                child: Row(
                                    mainAxisAlignment: MainAxisAlignment.start,
                                    children: [
                                  Expanded(
                                    flex: 7,
                                    child: Column(
                                      crossAxisAlignment:
                                          CrossAxisAlignment.start,
                                      children: [
                                        Align(
                                            alignment: FractionalOffset.topLeft,
                                            child: Row(
                                              mainAxisAlignment:
                                                  MainAxisAlignment
                                                      .spaceBetween,
                                              children: [
                                                Row(
                                                  children: [
                                                    Padding(
                                                      padding: EdgeInsets.only(
                                                          right: 7),
                                                      child: Container(
                                                        height: 24,
                                                        child: Image.asset(
                                                            'lib/icons/bemo.png',
                                                            color:
                                                                Colors.black87),
                                                      ),
                                                    ),
                                                    Text(
                                                      "${_listInfo[0]} - ${_listInfo[1]}",
                                                      style: TextStyle(
                                                        fontSize: 14,
                                                        fontWeight:
                                                            FontWeight.bold,
                                                        color: Colors.black87,
                                                      ),
                                                      softWrap: true,
                                                      maxLines: 3,
                                                      overflow: TextOverflow
                                                          .fade, //new
                                                    ),
                                                  ],
                                                ),
                                                Text(
                                                  "${_listInfo[2]}",
                                                  style: TextStyle(
                                                    fontSize: 14,
                                                    fontWeight: FontWeight.bold,
                                                    color: Colors.black87,
                                                  ),
                                                  softWrap: true,
                                                  maxLines: 3,
                                                  overflow:
                                                      TextOverflow.fade, //new
                                                ),
                                              ],
                                            )),
                                        SizedBox(height: 15),
                                        Expanded(
                                          child: ListView.builder(
                                              scrollDirection: Axis.horizontal,
                                              shrinkWrap: true,
                                              itemCount:
                                                  _listPilihIconWithChevron
                                                          .length -
                                                      1,
                                              itemBuilder: (_, i) => Expanded(
                                                    child:
                                                        _listPilihIconWithChevron[
                                                                    i] ==
                                                                "next"
                                                            ? Container(
                                                                height: 15,
                                                                child:
                                                                    Image.asset(
                                                                  'lib/icons/${_listPilihIconWithChevron[i]}.png',
                                                                  color: Colors
                                                                      .black45,
                                                                ),
                                                              )
                                                            : Container(
                                                                height: 20,
                                                                child:
                                                                    Image.asset(
                                                                  'lib/icons/${_listPilihIconWithChevron[i]}.png',
                                                                  color: Colors
                                                                      .black,
                                                                ),
                                                              ),
                                                  )),
                                        ),
                                        SizedBox(
                                          height: 10,
                                        ),
                                        SizedBox(
                                            height: 30,
                                            child: TextButton(
                                                onPressed: () {
                                                  setState(() {
                                                    _showList = 1;
                                                    refresh2_2();
                                                  });
                                                },
                                                child: Text(
                                                  "Details",
                                                  style: TextStyle(
                                                    fontSize: 14,
                                                    fontWeight: FontWeight.bold,
                                                    color: Color.fromRGBO(
                                                        255, 22, 93, 1),
                                                  ),
                                                )))
                                      ],
                                    ),
                                  ),
                                ]))))));
          });
    } else {
      return Container();
    }
  }

  //button transport transit n bemo
  int _showsteps3 = 0;
  Widget showSteps3(int _showsteps3) {
    if (_showsteps3 == 1) {
      return DraggableScrollableSheet(
          initialChildSize: 0.184,
          minChildSize: 0.184,
          maxChildSize: 0.184,
          builder: (BuildContext context, ScrollController scrollController) {
            return SingleChildScrollView(
                controller: scrollController,
                child: Card(
                    elevation: 12.0,
                    shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.only(
                            topLeft: Radius.circular(24),
                            topRight: Radius.circular(24))),
                    margin: const EdgeInsets.all(0),
                    child: Container(
                        height: 141,
                        decoration: BoxDecoration(
                          borderRadius: BorderRadius.only(
                              topLeft: Radius.circular(24),
                              topRight: Radius.circular(24)),
                        ),
                        child: Container(
                            height: 95,
                            width: MediaQuery.of(context).size.width * 0.9,
                            padding: EdgeInsets.all(15),
                            // ignore: prefer_const_constructors
                            decoration: BoxDecoration(
                                borderRadius: const BorderRadius.only(
                                    topRight: Radius.circular(16),
                                    topLeft: Radius.circular(16)),
                                color: Color.fromRGBO(246, 247, 215, 1)),
                            child: Expanded(
                                child: Row(
                                    mainAxisAlignment: MainAxisAlignment.start,
                                    children: [
                                  Expanded(
                                    flex: 7,
                                    child: Column(
                                      crossAxisAlignment:
                                          CrossAxisAlignment.start,
                                      children: [
                                        Align(
                                            alignment: FractionalOffset.topLeft,
                                            child: Row(
                                              mainAxisAlignment:
                                                  MainAxisAlignment
                                                      .spaceBetween,
                                              children: [
                                                Row(
                                                  children: [
                                                    Padding(
                                                      padding: EdgeInsets.only(
                                                          right: 7),
                                                      child: Container(
                                                        height: 24,
                                                        child: Image.asset(
                                                            'lib/icons/transitandbemo.png',
                                                            color:
                                                                Colors.black87),
                                                      ),
                                                    ),
                                                    Text(
                                                      "${_listInfo[0]} - ${_listInfo[1]}",
                                                      style: TextStyle(
                                                        fontSize: 14,
                                                        fontWeight:
                                                            FontWeight.bold,
                                                        color: Colors.black87,
                                                      ),
                                                      softWrap: true,
                                                      maxLines: 3,
                                                      overflow: TextOverflow
                                                          .fade, //new
                                                    ),
                                                  ],
                                                ),
                                                Text(
                                                  "${_listInfo[2]}",
                                                  style: TextStyle(
                                                    fontSize: 14,
                                                    fontWeight: FontWeight.bold,
                                                    color: Colors.black87,
                                                  ),
                                                  softWrap: true,
                                                  maxLines: 3,
                                                  overflow:
                                                      TextOverflow.fade, //new
                                                ),
                                              ],
                                            )),
                                        SizedBox(height: 15),
                                        Expanded(
                                          child: ListView.builder(
                                              scrollDirection: Axis.horizontal,
                                              shrinkWrap: true,
                                              itemCount:
                                                  _listPilihIconWithChevron
                                                          .length -
                                                      1,
                                              itemBuilder: (_, i) => Expanded(
                                                    child:
                                                        _listPilihIconWithChevron[
                                                                    i] ==
                                                                "next"
                                                            ? Container(
                                                                height: 15,
                                                                child:
                                                                    Image.asset(
                                                                  'lib/icons/${_listPilihIconWithChevron[i]}.png',
                                                                  color: Colors
                                                                      .black45,
                                                                ),
                                                              )
                                                            : Container(
                                                                height: 20,
                                                                child:
                                                                    Image.asset(
                                                                  'lib/icons/${_listPilihIconWithChevron[i]}.png',
                                                                  color: Colors
                                                                      .black,
                                                                ),
                                                              ),
                                                  )),
                                        ),
                                        SizedBox(
                                          height: 10,
                                        ),
                                        SizedBox(
                                            height: 30,
                                            child: TextButton(
                                                onPressed: () {
                                                  setState(() {
                                                    _showList = 1;
                                                    refresh2_3();
                                                  });
                                                },
                                                child: Text(
                                                  "Details",
                                                  style: TextStyle(
                                                    fontSize: 14,
                                                    fontWeight: FontWeight.bold,
                                                    color: Color.fromRGBO(
                                                        255, 22, 93, 1),
                                                  ),
                                                )))
                                      ],
                                    ),
                                  ),
                                ]))))));
          });
    } else {
      return Container();
    }
  }

  //show pilihan button transport
  int _showRute = 1;
  Widget showRoute(int _showRute) {
    if (_showRute == 1) {
      return SizedBox(
        height: 280,
        child: Row(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            ElevatedButton.icon(
              style: ButtonStyle(
                  backgroundColor: MaterialStateProperty.all<Color>(
                      Color.fromRGBO(255, 154, 0, 1)),
                  shape: MaterialStateProperty.all<RoundedRectangleBorder>(
                      RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(18.0),
                  ))),
              onPressed: () async {
                if (_originController.text == "Your location") {
                  var directions = await LocationService().getHome(
                      curLat.toString(),
                      curLng.toString(),
                      destLat.toString(),
                      destLng.toString());
                  int _polylineIdCounter = 1;
                  _polylines = Set<Polyline>();
                  _markers = <MarkerId, Marker>{};
                  _CameraRoutes(
                    directions['start_location']['lat'],
                    directions['start_location']['lng'],
                    directions['bounds_ne'],
                    directions['bounds_sw'],
                    directions['end_location']['lat'],
                    directions['end_location']['lng'],
                  );
                  jarak = directions['jarak'];
                  waktuTempuh = directions['durasi'];
                  _cariJalan(directions['steps']);

                  var tampung = directions['returnlegs'];
                  var tampung2 = directions['returnroutes'];

                  _listTransportasi = [];
                  _listInstruksi = [];
                  _listPilihIcon = [];
                  _listPilihIconWithChevron = [];
                  _listWaktuTempuhPerTransport = [];
                  _listInfo = [];
                  _listInfo.add(tampung2['departure_time']['text']);
                  _listInfo.add(tampung2['arrival_time']['text']);
                  _listInfo.add(tampung2['duration']['text']);
                  for (int i = 0; i < tampung.length; i++) {
                    if (tampung[i]['travel_mode'] == "WALKING") {
                      _listTransportasi.add("Walk");
                      _listWaktuTempuhPerTransport
                          .add(tampung[i]['duration']['text']);
                      _listInstruksi.add(tampung[i]['html_instructions']);
                      _listPilihIcon.add("walk");
                      _listPilihIconWithChevron.add("walk");
                      _listPilihIconWithChevron.add("next");
                    } else {
                      // BIS
                      if (tampung[i]['transit_details']['line']['vehicle']
                              ['name'] ==
                          "Bus") {
                        if (tampung[i]['transit_details']['line']['short_name'] ==
                            null) {
                          _listTransportasi.add("X");
                          _listInstruksi.add("Take X bus from Halte " +
                              tampung[i]['transit_details']['departure_stop']
                                  ['name'] +
                              " to Halte " +
                              tampung[i]['transit_details']['arrival_stop']
                                  ['name']);
                        } else {
                          _listTransportasi.add(tampung[i]['transit_details']
                              ['line']['short_name']);
                          _listInstruksi.add("Take " +
                              tampung[i]['transit_details']['line']
                                  ['short_name'] +
                              " bus from Halte " +
                              tampung[i]['transit_details']['departure_stop']
                                  ['name'] +
                              " to Halte " +
                              tampung[i]['transit_details']['arrival_stop']
                                  ['name']);
                        }
                        _listWaktuTempuhPerTransport
                            .add(tampung[i]['duration']['text']);
                        _listPilihIcon.add("bus");
                        _listPilihIconWithChevron.add("bus");
                        _listPilihIconWithChevron.add("next");
                      } else if (tampung[i]['transit_details']['line']['vehicle']
                              ['name'] ==
                          "Train") {
                        // KERETA
                        _listTransportasi
                            .add(tampung[i]['transit_details']['line']['name']);
                        _listInstruksi.add("Take " +
                            tampung[i]['transit_details']['line']['name'] +
                            " train from " +
                            tampung[i]['transit_details']['departure_stop']
                                ['name'] +
                            " to " +
                            tampung[i]['transit_details']['arrival_stop']
                                ['name']);
                        _listWaktuTempuhPerTransport
                            .add(tampung[i]['duration']['text']);
                        _listPilihIcon.add("train");
                        _listPilihIconWithChevron.add("train");
                        _listPilihIconWithChevron.add("next");
                      }
                    }
                  }
                } else {
                  var directions = await LocationService().getHome2(
                      _originController.text,
                      destLat.toString(),
                      destLng.toString());
                  int _polylineIdCounter = 1;
                  _polylines = Set<Polyline>();
                  _markers = <MarkerId, Marker>{};
                  _CameraRoutes(
                    directions['start_location']['lat'],
                    directions['start_location']['lng'],
                    directions['bounds_ne'],
                    directions['bounds_sw'],
                    directions['end_location']['lat'],
                    directions['end_location']['lng'],
                  );
                  jarak = directions['jarak'];
                  waktuTempuh = directions['durasi'];
                  _cariJalan(directions['steps']);

                  var tampung = directions['returnlegs'];
                  var tampung2 = directions['returnroutes'];

                  _listTransportasi = [];
                  _listInstruksi = [];
                  _listPilihIcon = [];
                  _listPilihIconWithChevron = [];
                  _listWaktuTempuhPerTransport = [];
                  _listInfo = [];
                  _listInfo.add(tampung2['departure_time']['text']);
                  _listInfo.add(tampung2['arrival_time']['text']);
                  _listInfo.add(tampung2['duration']['text']);
                  for (int i = 0; i < tampung.length; i++) {
                    if (tampung[i]['travel_mode'] == "WALKING") {
                      _listTransportasi.add("Walk");
                      _listWaktuTempuhPerTransport
                          .add(tampung[i]['duration']['text']);
                      _listInstruksi.add(tampung[i]['html_instructions']);
                      _listPilihIcon.add("walk");
                      _listPilihIconWithChevron.add("walk");
                      _listPilihIconWithChevron.add("next");
                    } else {
                      // BIS
                      if (tampung[i]['transit_details']['line']['vehicle']
                              ['name'] ==
                          "Bus") {
                        if (tampung[i]['transit_details']['line']['short_name'] ==
                            null) {
                          _listTransportasi.add("X");
                          _listInstruksi.add("Take X bus from Halte " +
                              tampung[i]['transit_details']['departure_stop']
                                  ['name'] +
                              " to Halte " +
                              tampung[i]['transit_details']['arrival_stop']
                                  ['name']);
                        } else {
                          _listTransportasi.add(tampung[i]['transit_details']
                              ['line']['short_name']);
                          _listInstruksi.add("Take " +
                              tampung[i]['transit_details']['line']
                                  ['short_name'] +
                              " bus from Halte " +
                              tampung[i]['transit_details']['departure_stop']
                                  ['name'] +
                              " to Halte " +
                              tampung[i]['transit_details']['arrival_stop']
                                  ['name']);
                        }
                        _listWaktuTempuhPerTransport
                            .add(tampung[i]['duration']['text']);
                        _listPilihIcon.add("bus");
                        _listPilihIconWithChevron.add("bus");
                        _listPilihIconWithChevron.add("next");
                      } else if (tampung[i]['transit_details']['line']['vehicle']
                              ['name'] ==
                          "Train") {
                        // KERETA
                        _listTransportasi
                            .add(tampung[i]['transit_details']['line']['name']);
                        _listInstruksi.add("Take " +
                            tampung[i]['transit_details']['line']['name'] +
                            " train from " +
                            tampung[i]['transit_details']['departure_stop']
                                ['name'] +
                            " to " +
                            tampung[i]['transit_details']['arrival_stop']
                                ['name']);
                        _listWaktuTempuhPerTransport
                            .add(tampung[i]['duration']['text']);
                        _listPilihIcon.add("train");
                        _listPilihIconWithChevron.add("train");
                        _listPilihIconWithChevron.add("next");
                      }
                    }
                  }
                }
                

                setState(() {
                  _showsteps1 = 1;
                  refresh2_2();
                  refresh2_3();
                  refresh3();
                });
              },
              icon: Container(
                height: 20,
                child: Image.asset(
                  'lib/icons/bus.png',
                  color: Color.fromRGBO(246, 247, 215, 1),
                ),
              ), //icon data for elevated button
              label: Text(
                'Transit',
                style: TextStyle(
                  fontFamily: "Comfortaa",
                  fontSize: 12,
                ),
              ),
            ),
            SizedBox(
              width: 6,
            ),
            ElevatedButton.icon(
              style: ButtonStyle(
                  backgroundColor: MaterialStateProperty.all<Color>(
                      Color.fromRGBO(255, 154, 0, 1)),
                  shape: MaterialStateProperty.all<RoundedRectangleBorder>(
                      RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(18.0),
                  ))),
              onPressed: () async {
                if (_originController.text == "Your location") {
                  var directions = await LocationService().getHome(
                      curLat.toString(),
                      curLng.toString(),
                      destLat.toString(),
                      destLng.toString());

                  int _polylineIdCounter = 1;
                  _polylines = Set<Polyline>();
                  _markers = <MarkerId, Marker>{};
                  _CameraRoutes(
                    directions['start_location']['lat'],
                    directions['start_location']['lng'],
                    directions['bounds_ne'],
                    directions['bounds_sw'],
                    directions['end_location']['lat'],
                    directions['end_location']['lng'],
                  );

                  //FLASK N XAMPP HRS NYALA
                  var list = await listRute({
                    'lat': curLat,
                    'long': curLng
                  }, {
                    'lat': directions['end_location']['lat'],
                    'long': directions['end_location']['lng']
                  }, 0, 0);
                } else {
                  var directions = await LocationService().getHome2(
                      _originController.text,
                      destLat.toString(),
                      destLng.toString());

                  int _polylineIdCounter = 1;
                  _polylines = Set<Polyline>();
                  _markers = <MarkerId, Marker>{};
                  _CameraRoutes(
                    directions['start_location']['lat'],
                    directions['start_location']['lng'],
                    directions['bounds_ne'],
                    directions['bounds_sw'],
                    directions['end_location']['lat'],
                    directions['end_location']['lng'],
                  );

                  //FLASK N XAMPP HRS NYALA
                  var list = await listRute({
                    'lat': directions['start_location']['lat'],
                    'long': directions['start_location']['lng'],
                  }, {
                    'lat': directions['end_location']['lat'],
                    'long': directions['end_location']['lng']
                  }, 0, 0);
                }


                

                // var haltee = await extractLatLongHalte(data: directions);
                // if (haltee.length > 0) {
                //   var listBemoBus = await listRute(
                //       {
                //         // bemo + bus
                //         'lat': curLat,
                //         'long': curLng
                //       },
                //       {
                //         'lat': directions['end_location']['lat'],
                //         'long': directions['end_location']['lng']
                //       },
                //       haltee[0]['transit_details']['arrival_stop']
                //           ['location'],
                //       haltee[haltee.length - 1]['transit_details']
                //           ['arrival_stop']['location']);
                // }

                setState(() {
                  _showsteps2 = 1;
                  refresh2_1();
                  refresh2_3();
                  refresh3();
                });
              },
              icon: Container(
                height: 20,
                child: Image.asset(
                  'lib/icons/bemo.png',
                  color: Color.fromRGBO(246, 247, 215, 1),
                ),
              ), //icon data for elevated button
              label: Text(
                'Bemo',
                style: TextStyle(
                  fontFamily: "Comfortaa",
                  fontSize: 12,
                ),
              ),
            ),
            SizedBox(
              width: 6,
            ),
            ElevatedButton.icon(
              style: ButtonStyle(
                  backgroundColor: MaterialStateProperty.all<Color>(
                      Color.fromRGBO(255, 154, 0, 1)),
                  shape: MaterialStateProperty.all<RoundedRectangleBorder>(
                      RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(18.0),
                  ))),
              onPressed: () async {
                if (_originController.text == "Your location") {
                  var directions = await LocationService().getHome(
                      curLat.toString(),
                      curLng.toString(),
                      destLat.toString(),
                      destLng.toString());
                  int _polylineIdCounter = 1;
                  _polylines = Set<Polyline>();
                  _markers = <MarkerId, Marker>{};
                  _CameraRoutes(
                    directions['start_location']['lat'],
                    directions['start_location']['lng'],
                    directions['bounds_ne'],
                    directions['bounds_sw'],
                    directions['end_location']['lat'],
                    directions['end_location']['lng'],
                  );

                  //FLASK N XAMPP HRS NYALA
                  List haltee = await extractLatLongHalte(data: directions);
                  print(haltee.length);
                  if (haltee.length > 0) {
                    var listBemoBus = await listRute({
                      // bemo + bus
                      'lat': curLat,
                      'long': curLng
                    }, {
                      'lat': directions['end_location']['lat'],
                      'long': directions['end_location']['lng']
                    }, {
                      'lat': haltee[0]['arrival_stop']['location']['lat'],
                      "long": haltee[0]['arrival_stop']['location']['lat']
                    }, {
                      'lat': haltee[haltee.length - 1]['arrival_stop']['location']
                          ['lat'],
                      "long": haltee[haltee.length - 1]['arrival_stop']
                          ['location']['lat']
                    });
                  }
                } else {
                  var directions = await LocationService().getHome2(
                      _originController.text,
                      destLat.toString(),
                      destLng.toString());
                  int _polylineIdCounter = 1;
                  _polylines = Set<Polyline>();
                  _markers = <MarkerId, Marker>{};
                  _CameraRoutes(
                    directions['start_location']['lat'],
                    directions['start_location']['lng'],
                    directions['bounds_ne'],
                    directions['bounds_sw'],
                    directions['end_location']['lat'],
                    directions['end_location']['lng'],
                  );

                  //FLASK N XAMPP HRS NYALA
                  List haltee = await extractLatLongHalte(data: directions);
                  print(haltee.length);
                  if (haltee.length > 0) {
                    var listBemoBus = await listRute({
                      // bemo + bus
                      'lat': directions['start_location']['lat'],
                      'long': directions['start_location']['lng'],
                    }, {
                      'lat': directions['end_location']['lat'],
                      'long': directions['end_location']['lng']
                    }, {
                      'lat': haltee[0]['arrival_stop']['location']['lat'],
                      "long": haltee[0]['arrival_stop']['location']['lat']
                    }, {
                      'lat': haltee[haltee.length - 1]['arrival_stop']['location']
                          ['lat'],
                      "long": haltee[haltee.length - 1]['arrival_stop']
                          ['location']['lat']
                    });
                  }
                }
                

                setState(() {
                  _showsteps3 = 1;
                  refresh2_1();
                  refresh2_2();
                  refresh3();
                });
              },
              icon: Container(
                height: 24,
                child: Image.asset(
                  'lib/icons/transitandbemo.png',
                  color: Color.fromRGBO(246, 247, 215, 1),
                ),
              ), //icon data for elevated button
              label: Text(
                'Transit and Bemo',
                style: TextStyle(
                  fontFamily: "Comfortaa",
                  fontSize: 12,
                ),
              ),
            ),
          ],
        ),
      );
    }

    return Container();
  }

  Future<void> _CameraRoutes(
      double lat,
      double lng,
      Map<String, dynamic> boundsNe,
      Map<String, dynamic> boundsSw,
      double latTujuan,
      double lngTujuan) async {
    final GoogleMapController controller = await _controller.future;
    controller.animateCamera(CameraUpdate.newCameraPosition(
      CameraPosition(target: LatLng(lat, lng), zoom: 15),
    ));
    controller.animateCamera(
      CameraUpdate.newLatLngBounds(
          LatLngBounds(
            southwest: LatLng(boundsSw['lat'], boundsSw['lng']),
            northeast: LatLng(boundsNe['lat'], boundsNe['lng']),
          ),
          25),
    );
    _setMarker(LatLng(lat, lng), "100");
    _setMarker(LatLng(latTujuan, lngTujuan), "101");
  }

  Future<void> _CameraDestination(Map<String, dynamic> boundsNe,
      Map<String, dynamic> boundsSw, double latTujuan, double lngTujuan) async {
    final GoogleMapController controller = await _controller.future;
    // controller.animateCamera(CameraUpdate.newCameraPosition(
    //   CameraPosition(target: LatLng(lat, lng), zoom: 18),
    // ));
    controller.animateCamera(
      CameraUpdate.newLatLngBounds(
          LatLngBounds(
            southwest: LatLng(boundsSw['lat'], boundsSw['lng']),
            northeast: LatLng(boundsNe['lat'], boundsNe['lng']),
          ),
          25),
    );
    controller.animateCamera(CameraUpdate.newCameraPosition(
      CameraPosition(target: LatLng(latTujuan, lngTujuan), zoom: 15),
    ));
    _setMarker(LatLng(latTujuan, lngTujuan), "1");
    // _setMarker(LatLng(lat, lng), "2");
  }

  Future<Position> _determinePosition() async {
    bool serviceEnabled;
    LocationPermission permission;

    serviceEnabled = await Geolocator.isLocationServiceEnabled();

    if (!serviceEnabled) {
      return Future.error('Location service is disabled!');
    }

    permission = await Geolocator.checkPermission();

    if (permission == LocationPermission.denied) {
      permission = await Geolocator.requestPermission();

      if (permission == LocationPermission.denied) {
        return Future.error('Location permission denied!');
      }
    }

    if (permission == LocationPermission.deniedForever) {
      return Future.error('Location permission is denied permanently!');
    }

    Position position = await Geolocator.getCurrentPosition();
    return position;
  }

  Future<void> _cariJalan(steps) async {
    var counter = 0;
    for (var i in steps) {
      _setMarker(LatLng(i['end_location']['lat'], i['end_location']['lng']),
          counter.toString());
      counter++;
      _setPolyline(PolylinePoints().decodePolyline(i['polyline']['points']),
          counter.toString(),
          mode: i['travel_mode']);
    }
  }

  Future<int> _cariJalanBuatBemo(steps, counter) async {
    int count = counter;
    _setMarker(
        LatLng(
            steps[0]['end_location']['lat'], steps[0]['end_location']['lng']),
        counter.toString());
    counter++;
    _setMarker(
        LatLng(steps[steps.length - 1]['end_location']['lat'],
            steps[steps.length - 1]['end_location']['lng']),
        counter.toString());
    for (var i in steps) {
      _setPolyline(PolylinePoints().decodePolyline(i['polyline']['points']),
          counter.toString(),
          mode: i[
              'travel_mode']); // travelmode tidak ada di semua tempat, jadie polyline e gk ketok
      counter++;
    }
    count = counter;
    return count;
  }

  Future<List> listRute(
      latLongAwal, latLongAkhir, latLongHalteAwal, latLongHalteAkhir) async {
    SharedPreferences sharedPreferences = await SharedPreferences.getInstance();
    // Map data = {};
    print('bisa masuk');

    Map data = {
      'awal': latLongAwal,
      'akhir': latLongAkhir,
      'halteAwal': latLongHalteAwal,
      'halteAkhir': latLongHalteAkhir
    };

    var body = jsonEncode(data);
    print(body);

    var response = await http.post(Uri.parse("http://10.0.2.2:5000/rute"),
        headers: {'Content-Type': 'application/json'},
        body: body,
        encoding: Encoding.getByName("utf-8"));

    print("testtststtts");

    final stops = <String>[];
    final coords = <List<double>>[];
    final bemos = <String>[];

    // print('huwalahumbaaa');
    var datasamting = jsonDecode(response.body);

    for (final route in datasamting) {
      for (final subroute in route) {
        for (final segment in subroute) {
          print(segment);
          print("segmentttttttttttttt");
          bemos.add(segment[1]);
          stops.add(segment[3]['Stop']);
          coords.add([segment[3]['lat'], segment[3]['long']]);

          stops.add(segment[5]['Stop']);
          coords.add([segment[5]['lat'], segment[5]['long']]);
          break;
        }
      }
    }
    if (latLongHalteAwal == 0 && latLongHalteAkhir == 0) {
      cariPolyline(data, coords, stops, bemos);
    } else {
      cariPolylineBuatBemoBus(data, coords, stops, bemos);
    }

    print(stops);
    print(coords);
    return (datasamting);
  }

  Future cariPolyline(dataAwal, coords, stops, bemos) async {
    _listTransportasi = [];
    _listInstruksi = [];
    _listPilihIcon = [];
    _listPilihIconWithChevron = [];
    _listWaktuTempuhPerTransport = [];
    _listInfo = [];

    int count = 0;
    var directions = await LocationService().getDirectionsBemo(
        dataAwal['awal']['lat'].toString(),
        dataAwal['awal']['long'].toString(),
        coords[0][0].toString(),
        coords[0][1].toString(),
        ciri: "bukanbemo");
    count = await _cariJalanBuatBemo(directions['steps'], count);

    var tampung = directions['returnlegs'];
    var tampungWaktu = directions['returnroutes'];

    _listTransportasi.add("Walk");
    _listWaktuTempuhPerTransport.add(tampung[0]['duration']['text']);
    _listInstruksi.add(tampung[0]['html_instructions']);
    _listPilihIcon.add("walk");
    _listPilihIconWithChevron.add("walk");
    _listPilihIconWithChevron.add("next");
    // add sekali ke list

    for (var i = 0; i < coords.length - 1; i++) {
      if (i % 2 == 0) {
        var k = 0;
        var directions = await LocationService().getDirectionsBemo(
            coords[i][0].toString(),
            coords[i][1].toString(),
            coords[i + 1][0].toString(),
            coords[i + 1][1].toString(),
            ciri: "bemo");

        count = await _cariJalanBuatBemo(directions['steps'], count);

        var tampung = directions['returnlegs'];

        _listTransportasi.add(bemos[k]);
        _listWaktuTempuhPerTransport.add(tampung[0]['duration']['text']);
        _listInstruksi
            .add("Menggunakan bemo " + bemos[k] + " menuju " + stops[i + 1]);
        _listPilihIcon.add("bemo");
        _listPilihIconWithChevron.add("bemo");
        _listPilihIconWithChevron.add("next");
        k++;
      } else {
        var directions = await LocationService().getDirectionsBemo(
            coords[i][0].toString(),
            coords[i][1].toString(),
            coords[i + 1][0].toString(),
            coords[i + 1][1].toString(),
            ciri: "walking");
        count = await _cariJalanBuatBemo(directions['steps'], count);

        var tampung = directions['returnlegs'];

        for (int i = 0; i < tampung.length; i++) {
          if (tampung[i]['travel_mode'] == "WALKING") {
            _listTransportasi.add("Walk");
            _listWaktuTempuhPerTransport.add(tampung[i]['duration']['text']);
            _listInstruksi.add(tampung[i]['html_instructions']);
            _listPilihIcon.add("walk");
            _listPilihIconWithChevron.add("walk");
            _listPilihIconWithChevron.add("next");
          } else if (tampung[i]['travel_mode'] == "TRANSIT") {
            // BIS
            if (tampung[i]['transit_details']['line']['vehicle']['name'] ==
                "Bus") {
              if (tampung[i]['transit_details']['line']['short_name'] == null) {
                _listTransportasi.add("X");
                _listInstruksi.add("Take X bus from Halte " +
                    tampung[i]['transit_details']['departure_stop']['name'] +
                    " to Halte " +
                    tampung[i]['transit_details']['arrival_stop']['name']);
              } else {
                _listTransportasi
                    .add(tampung[i]['transit_details']['line']['short_name']);
                _listInstruksi.add("Take " +
                    tampung[i]['transit_details']['line']['short_name'] +
                    " bus from Halte " +
                    tampung[i]['transit_details']['departure_stop']['name'] +
                    " to Halte " +
                    tampung[i]['transit_details']['arrival_stop']['name']);
              }
              _listWaktuTempuhPerTransport.add(tampung[i]['duration']['text']);
              _listPilihIcon.add("bus");
              _listPilihIconWithChevron.add("bus");
              _listPilihIconWithChevron.add("next");
            } else if (tampung[i]['transit_details']['line']['vehicle']
                    ['name'] ==
                "Train") {
              // KERETA
              _listTransportasi
                  .add(tampung[i]['transit_details']['line']['name']);
              _listInstruksi.add("Take " +
                  tampung[i]['transit_details']['line']['name'] +
                  " train from " +
                  tampung[i]['transit_details']['departure_stop']['name'] +
                  " to " +
                  tampung[i]['transit_details']['arrival_stop']['name']);
              _listWaktuTempuhPerTransport.add(tampung[i]['duration']['text']);
              _listPilihIcon.add("train");
              _listPilihIconWithChevron.add("train");
              _listPilihIconWithChevron.add("next");
            }
          }
        }
      }
    }
    ;

    var directions2 = await LocationService().getDirectionsBemo(
        coords[coords.length - 1][0].toString(),
        coords[coords.length - 1][1].toString(),
        dataAwal['akhir']['lat'].toString(),
        dataAwal['akhir']['long'].toString(),
        ciri: "bukanbemo");
    count = await _cariJalanBuatBemo(directions2['steps'], count);

    var tampungAkhir = directions2['returnlegs'];
    for (int i = 0; i < tampungAkhir.length; i++) {
      if (tampungAkhir[i]['travel_mode'] == "WALKING") {
        _listTransportasi.add("Walk");
        _listWaktuTempuhPerTransport.add(tampungAkhir[i]['duration']['text']);
        _listInstruksi.add(tampungAkhir[i]['html_instructions']);
        _listPilihIcon.add("walk");
        _listPilihIconWithChevron.add("walk");
        _listPilihIconWithChevron.add("next");
      } else if (tampungAkhir[i]['travel_mode'] == "TRANSIT") {
        // BIS
        if (tampungAkhir[i]['transit_details']['line']['vehicle']['name'] ==
            "Bus") {
          if (tampungAkhir[i]['transit_details']['line']['short_name'] ==
              null) {
            _listTransportasi.add("X");
            _listInstruksi.add("Take X bus from Halte " +
                tampungAkhir[i]['transit_details']['departure_stop']['name'] +
                " to Halte " +
                tampungAkhir[i]['transit_details']['arrival_stop']['name']);
          } else {
            _listTransportasi
                .add(tampungAkhir[i]['transit_details']['line']['short_name']);
            _listInstruksi.add("Take " +
                tampungAkhir[i]['transit_details']['line']['short_name'] +
                " bus from Halte " +
                tampungAkhir[i]['transit_details']['departure_stop']['name'] +
                " to Halte " +
                tampungAkhir[i]['transit_details']['arrival_stop']['name']);
          }
          _listWaktuTempuhPerTransport.add(tampungAkhir[i]['duration']['text']);
          _listPilihIcon.add("bus");
          _listPilihIconWithChevron.add("bus");
          _listPilihIconWithChevron.add("next");
        } else if (tampungAkhir[i]['transit_details']['line']['vehicle']
                ['name'] ==
            "Train") {
          // KERETA
          _listTransportasi
              .add(tampungAkhir[i]['transit_details']['line']['name']);
          _listInstruksi.add("Take " +
              tampungAkhir[i]['transit_details']['line']['name'] +
              " train from " +
              tampungAkhir[i]['transit_details']['departure_stop']['name'] +
              " to " +
              tampungAkhir[i]['transit_details']['arrival_stop']['name']);
          _listWaktuTempuhPerTransport.add(tampungAkhir[i]['duration']['text']);
          _listPilihIcon.add("train");
          _listPilihIconWithChevron.add("train");
          _listPilihIconWithChevron.add("next");
        }
      }
    }
    var tampungAkhirWaktu = directions2['returnroutes'];

    // _listInfo.add(tampungWaktu['departure_time']['text']);
    // _listInfo.add(tampungAkhirWaktu['arrival_time']['text']);
    // _listInfo.add("+-");
    _listInfo.add("10.00");
    _listInfo.add("11.00");
    _listInfo.add("+-");
    print("bemo aja");
    print("info " + _listInfo.length.toString());
    print("Instruksi" + _listInstruksi.length.toString());
    print("icon " + _listPilihIcon.length.toString());
    print("Icon with Chevron " + _listPilihIconWithChevron.length.toString());
    print("Transportasi " + _listTransportasi.length.toString());
    print("waktu tempuh " + _listWaktuTempuhPerTransport.length.toString());
  }

  Future cariPolylineBuatBemoBus(dataAwal, coords, stops, bemos) async {
    _listTransportasi = [];
    _listInstruksi = [];
    _listPilihIcon = [];
    _listPilihIconWithChevron = [];
    _listWaktuTempuhPerTransport = [];
    _listInfo = [];

    int count = 0;
    var directions = await LocationService().getDirectionsBemo(
        dataAwal['awal']['lat'].toString(),
        dataAwal['awal']['long'].toString(),
        coords[0][0].toString(),
        coords[0][1].toString(),
        ciri: "bukanbemo");
    count = await _cariJalanBuatBemo(directions['steps'], count);

    var tampung = directions['returnlegs'];
    var tampungWaktu = directions['returnroutes'];

    _listTransportasi.add("Walk");
    _listWaktuTempuhPerTransport.add(tampung[0]['duration']['text']);
    _listInstruksi.add(tampung[0]['html_instructions']);
    _listPilihIcon.add("walk");
    _listPilihIconWithChevron.add("walk");
    _listPilihIconWithChevron.add("next");
    // add sekali ke list

    for (var i = 0; i < coords.length - 1; i++) {
      if (i % 2 == 0) {
        var k = 0;
        var directions = await LocationService().getDirectionsBemo(
            coords[i][0].toString(),
            coords[i][1].toString(),
            coords[i + 1][0].toString(),
            coords[i + 1][1].toString(),
            ciri: "bemo");

        count = await _cariJalanBuatBemo(directions['steps'], count);

        var tampung = directions['returnlegs'];

        _listTransportasi.add(bemos[k]);
        _listWaktuTempuhPerTransport.add(tampung[0]['duration']['text']);
        _listInstruksi
            .add("Menggunakan bemo " + bemos[k] + " menuju " + stops[i + 1]);
        _listPilihIcon.add("bemo");
        _listPilihIconWithChevron.add("bemo");
        _listPilihIconWithChevron.add("next");
        k++;
      } else {
        var directions = await LocationService().getDirectionsBemo(
            coords[i][0].toString(),
            coords[i][1].toString(),
            coords[i + 1][0].toString(),
            coords[i + 1][1].toString(),
            ciri: "walking");
        count = await _cariJalanBuatBemo(directions['steps'], count);

        var tampung = directions['returnlegs'];

        for (int i = 0; i < tampung.length; i++) {
          _listTransportasi.add("Walk");
          _listWaktuTempuhPerTransport.add(tampung[i]['duration']['text']);
          _listInstruksi.add(tampung[i]['html_instructions']);
          _listPilihIcon.add("walk");
          _listPilihIconWithChevron.add("walk");
          _listPilihIconWithChevron.add("next");
        }
      }
    }
    ;

    var directions2 = await LocationService().getDirectionsBemo(
        coords[coords.length - 1][0].toString(),
        coords[coords.length - 1][1].toString(),
        dataAwal['akhir']['lat'].toString(),
        dataAwal['akhir']['long'].toString(),
        ciri: "walking");
    count = await _cariJalanBuatBemo(directions2['steps'], count);

    var tampungAkhir = directions2['returnlegs'];
    var tampungAkhirWaktu = directions2['returnroutes'];
    for (int i = 0; i < tampungAkhir.length; i++) {
      _listTransportasi.add("Walk");
      _listWaktuTempuhPerTransport.add(tampungAkhir[i]['duration']['text']);
      _listInstruksi.add(tampungAkhir[i]['html_instructions']);
      _listPilihIcon.add("walk");
      _listPilihIconWithChevron.add("walk");
      _listPilihIconWithChevron.add("next");
    }
    // _listInfo.add(tampungWaktu['departure_time']['text']);
    // _listInfo.add(tampungAkhirWaktu['arrival_time']['text']);
    // _listInfo.add("+-");
    _listInfo.add("10.00");
    _listInfo.add("11.00");
    _listInfo.add("+-");
    print("busbemo");
    print("info " + _listInfo.length.toString());
    print("Instruksi" + _listInstruksi.length.toString());
    print("icon " + _listPilihIcon.length.toString());
    print("Icon with Chevron " + _listPilihIconWithChevron.length.toString());
    print("Transportasi " + _listTransportasi.length.toString());
    print("waktu tempuh " + _listWaktuTempuhPerTransport.length.toString());
  }

  Future<List> extractLatLongHalte({var data = 0}) async {
    var listHalte = [];
    var apaYa = data['steps'];
    if (data == 0) {
      return [];
    } else {
      for (var i in apaYa) {
        print(i);
        print("----");

        if (i.containsKey('transit_details')) {
          // gk gelem keambilllllllllllllllll AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
          print(i['transit_details']);
          print('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA');
          listHalte.add(i['transit_details']);
        }
      }

      print(listHalte);
      return listHalte;
    }
  }
}
