// import 'package:flutter/cupertino.dart';
import 'package:amin_bisa/main.dart';
import 'package:flutter/material.dart';
import 'package:amin_bisa/view/screens/edit_profile.dart';
// import 'package:pp/screens/edit_profile.dart';
import 'package:amin_bisa/view/screens/profile_body_screen.dart';

// import 'package:google_fonts/google_fonts.dart';

class ProfileScreen extends StatelessWidget {
  const ProfileScreen({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      // appBar: AppBar(
      //   backgroundColor: Colors.pink[100],
      //   elevation: 5,
      //   title: Text(
      //     "Transtreet",
      //     style: TextStyle(
      //       fontFamily: "Sriracha", 
      //       fontSize: 26
      //     ),
      //   ),
      //   // actions: [
      //   //   IconButton(
      //   //       onPressed: () {
      //   //         Navigator.push(
      //   //             context,
      //   //             MaterialPageRoute(
      //   //                 builder: (context) => const EditProfileScreen()));
      //   //       },
      //   //       icon: const Icon(Icons.edit)),
      //   // ],
      //   // leading: Builder(
      //   //   builder: (BuildContext context) {
      //   //     return IconButton(
      //   //       icon: const Icon(Icons.arrow_back),
      //   //       onPressed:
      //   //           () {

      //   //           }, //balek ke transstreet //{Scaffold.of(context).openDrawer();}
      //   //       // tooltip: MaterialLocalizations.of(context).openAppDrawerTooltip,
      //   //     );
      //   //   },
      //   // ),
      //   // centerTitle: true, //taruh tengah
      //   // backgroundColor: Color(0xFFF8BBD0),
      //   foregroundColor: Colors.white,
      // ),
      // appBar: AppBar(
      //   title: const Text(
      //     'Transtreet',
      //     style: TextStyle(
      //       fontFamily: 'Sriracha',
      //       fontSize: 40,
      //     ),
      //   ),
      //   // leading: const Icon(Icons.arrow_back),
      //   // leading: Builder(
      //   //   builder: (BuildContext context) {
      //   //     return IconButton(
      //   //       icon: const Icon(Icons.arrow_back),
      //   //       onPressed:
      //   //           () {}, //balek ke transstreet //{Scaffold.of(context).openDrawer();}
      //   //       // tooltip: MaterialLocalizations.of(context).openAppDrawerTooltip,
      //   //     );
      //   //   },
      //   // ),
      //   actions: [
      //     IconButton(
      //         onPressed: () {
      //           Navigator.push(
      //               context,
      //               MaterialPageRoute(
      //                   builder: (context) => const EditProfileScreen()));
      //         },
      //         icon: const Icon(Icons.edit)),
      //   ],
      //   centerTitle: true, //taruh tengah
      //   backgroundColor: Color(0xFFF8BBD0),
      //   foregroundColor: Colors.white,
      //   elevation: 0.0,
      // ),
      // backgroundColor: Color(0xff181818),
      body: const ProfileBodyScreen(),
    );
  }
}
