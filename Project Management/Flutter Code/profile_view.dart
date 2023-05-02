import 'dart:ffi';

import 'package:amin_bisa/view/screens/profile_screen.dart';
import 'package:amin_bisa/view/takeMeHome.dart';
import 'package:flutter/material.dart';
import 'package:flutter/src/widgets/container.dart';
import 'package:flutter/src/widgets/framework.dart';

class profileView extends StatefulWidget {
  const profileView({super.key});

  @override
  State<profileView> createState() => _profileViewState();
}

class _profileViewState extends State<profileView> {
  static String userName = 'Hidayah';
  static int age = 21;
  static String Home = 'home address';

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: ProfileScreen()
    //   body: Container(
    //     margin: EdgeInsets.all(20),
    //     child: Column(mainAxisAlignment: MainAxisAlignment.center, children: [
    //       Text(
    //         'Hello, $userName',
    //         style: TextStyle(fontSize: 20),
    //       ),
    //       SizedBox(
    //         height: 20,
    //       ),
    //       SizedBox(
    //         height: 20,
    //       ),
    //       SizedBox(
    //         height: 20,
    //       ),
    //       Row(
    //         children: [Text('Name: '), Text('$userName')],
    //       ),
    //       SizedBox(
    //         height: 20,
    //       ),
    //       Row(
    //         children: [Text('Age: '), Text('${age.toString()}')],
    //       ),
    //       SizedBox(
    //         height: 20,
    //       ),
    //       Row(
    //         mainAxisAlignment: MainAxisAlignment.start,
    //         children: [
    //           Text('Address: '),
    //           SizedBox(
    //             width: 40,
    //           ),
    //           ElevatedButton(
    //               onPressed: () {
    //                 Navigator.push(context,
    //                     MaterialPageRoute(builder: (context) => takeMehome()));
    //               },
    //               child: Text('Tambahkan alamat'))
    //         ],
    //       ),
    //       SizedBox(
    //         height: 50,
    //       ),
    //       ElevatedButton(
    //           onPressed: () {
    //             Navigator.pop(context);
    //           },
    //           child: Text('back'))
    //     ]),
    //   ),
    );
  }
}
