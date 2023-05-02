// import 'dart:ui';

import 'package:flutter/material.dart';

import 'edit_profile.dart';

// import 'package:google_fonts/google_fonts.dart';


class ProfileBodyScreen extends StatelessWidget {
  const ProfileBodyScreen({
    Key? key,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Color.fromRGBO(62, 193, 211, 1),
        elevation: 5,
        title: Text(
          "Transtreet",
          style: TextStyle(
            fontFamily: "Sriracha", 
            fontSize: 26,
            color: Color.fromRGBO(246, 247, 215, 1)
          ),
        ),
      ),
      body: Container(
        padding: EdgeInsets.all(20),
          child: 
          Stack(
            children: [
              Align(
                alignment: FractionalOffset.center,
                child: 
                Column(
                  children: [
                    SizedBox(height: 100,),
                    Card(
                      // shadowColor: Colors.black45,
                      elevation: 15,
                      color: Colors.white,
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.only(
                          topLeft: Radius.circular(24),
                          topRight: Radius.circular(24),
                          bottomLeft: Radius.circular(24),
                          bottomRight: Radius.circular(24),
                        )
                      ),
                      margin: const EdgeInsets.all(0),
                      child:
                        Container(
                          width: 400,
                          height: 480,
                      ),
                    ),
                  ],
                ),
              ),
              Align(
                alignment: FractionalOffset.topCenter,
                child:
                Column(
                  children: [
                    SizedBox(
                      height: 30,
                    ),
                    Container(
                        padding: const EdgeInsets.all(10),
                        decoration: const BoxDecoration(
                          
                          borderRadius: BorderRadius.all(
                            Radius.circular(50.0),
                          ),
                          // color: Colors.pinkAccent //Color(#xxx)
                        ),
                        // child: CircleAvatar(
                        //   child: Container(
                        //     height: 70,
                        //     child: Image.asset('lib/icons/hacker.png',),
                        //   ),
                        //   radius: 50.0,
                        //   backgroundColor: Colors.grey,
                          
                        // ),
                        child: CircleAvatar(
                        radius: 62,
                        backgroundColor: Colors.black87,
                        child: CircleAvatar(
                          radius: 60,
                          // backgroundImage: AssetImage('lib/icons/hacker.png'),
                          child: Container(
                            height: 80,
                            child: Image.asset('lib/icons/hacker.png',),
                          ),
                          backgroundColor: Colors.grey,
                        ),
                      )
                    ),
                  ],
                ),
              ),
              Align(
                alignment: FractionalOffset.center,
                child: 
                  Column(
                  children: [
                    SizedBox(height: 200,),
                    const Text(
                      'Monica Evelyn',
                      style: TextStyle(
                        fontSize: 24,
                        fontWeight: FontWeight.bold,
                        // color: Colors.white,
                      ),
                    ),
                    SizedBox(height: 40,),
                    const 
                    Text(
                      'mon@gmail.com',
                      style: TextStyle(
                        fontSize: 16,
                        color: Colors.black54,
                      ),
                    ),
                    SizedBox(height: 20,),
                    const Text(
                      '08123456789',
                      style: TextStyle(
                        fontSize: 16,
                        color: Colors.black54,
                      ),
                    ),
                    SizedBox(height: 20,),
                    const Text(
                      'Universitas Kristen Petra',
                      style: TextStyle(
                        fontSize: 16,
                        color: Colors.black54,
                      ),
                    ),
                    SizedBox(height: 60,),
                    Container(
                      width: 250,
                      height: 40,
                      child: ElevatedButton.icon(
                        style: ButtonStyle(
                          backgroundColor: MaterialStateProperty.all<Color>(
                            // Colors.teal[400]!
                            Color.fromRGBO(62, 193, 211, 1),),
                          shape: MaterialStateProperty.all<RoundedRectangleBorder>(
                            RoundedRectangleBorder(
                              borderRadius: BorderRadius.circular(18.0),                      
                            )
                          )
                        ),
                        onPressed: () async {
                          Navigator.push(
                            context,
                            MaterialPageRoute(
                                builder: (context) => const EditProfileScreen()));
                          },
                        icon: Container(
                          height: 20,
                          // child: Image.asset('lib/icons/location.png', color: Colors.white,),
                        ),  //icon data for elevated button
                        label: Text(
                          'Edit Profile',
                          style: TextStyle(
                            fontFamily: "Comfortaa",
                            fontSize: 18,
                            color: Color.fromRGBO(246, 247, 215, 1)
                          ),
                        ),
                      ),
                      // child: ElevatedButton(
                      //   onPressed: () {
                      //     Navigator.push(
                      //         context,
                      //         MaterialPageRoute(
                      //             builder: (context) => const EditProfileScreen()));
                      //   },
                      //   child: Text("EDIT WOI"),
                      // ),
                    ),
                    SizedBox(height: 30,),
                    InkWell(
                      onTap: () {},
                      child: Text(
                        'Log Out',
                        style: TextStyle(decoration: TextDecoration.underline, color: Colors.redAccent[700], fontSize: 16),
                      ),
                    )
                  ],
                ),
              )
            ],
          )
      )
    );
  }
}
