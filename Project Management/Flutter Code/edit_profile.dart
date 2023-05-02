// import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:amin_bisa/view/screens/profile_body_screen.dart';
import 'package:amin_bisa/view/screens/profile_screen.dart';

class EditProfileScreen extends StatelessWidget {
  const EditProfileScreen({Key? key}) : super(key: key);
  // final bool showPass = false;

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
      // backgroundColor: Color(0xff181818),
      body: Container(
        padding: EdgeInsets.only(left: 16, top: 15, right: 16),
        child: GestureDetector(
          onTap: () {
            FocusScope.of(context).unfocus();
          },
          child: ListView(
            children: [
              // const Text(
              //   'Edit Profile',
              //   textAlign: TextAlign.center,
              //   style: TextStyle(
              //     fontFamily: 'Comfortaa',
              //     fontSize: 25, 
              //     fontWeight: FontWeight.w500,
              //     // color: Colors.white,
              //   ),
              // ),
              SizedBox(
                height: 15,
              ),
              Align(
              alignment: FractionalOffset.topCenter,
              child:
                Column(
                  children: [
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
              SizedBox(height: 55),
              buildTextField("Full Name", "Monica Evelyn"),
              buildTextField("E-mail", "mon@gmail.com"),
              // buildTextField("Password", "Password", true),
              buildTextField("Phone Number", "0812345678"),
              buildTextField("Alamat", "Universitas Kristen Petra"),

              SizedBox(height: 5),

              Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Container(
                    height: 40,
                    child: OutlinedButton(
                      style: OutlinedButton.styleFrom(
                        padding: EdgeInsets.symmetric(horizontal: 50),
                        backgroundColor: Color.fromRGBO(246, 247, 215, 1),
                        shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(20)),
                      ),
                      onPressed: () {
                        Navigator.pop(
                          context,
                          MaterialPageRoute(
                              builder: (context) => const ProfileScreen()),
                        );
                      },
                      child: Text(
                        "Cancel",
                        style: TextStyle(
                            fontSize: 16,
                            letterSpacing: 2.2,
                            color: Colors.black87),
                      ),
                    ),
                  ),
                  SizedBox(width: 15,),
                  Container(
                    height: 40,
                    child: ElevatedButton(
                      onPressed: () {},
                      style: ElevatedButton.styleFrom(
                        backgroundColor: Color.fromRGBO(62, 193, 211, 1),
                        padding: EdgeInsets.symmetric(horizontal: 50),
                        shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(20)),
                        elevation: 2,
                      ),
                      child: Text(
                        "Save",
                        style: TextStyle(
                            fontSize: 16,
                            letterSpacing: 2.2,
                            color: Color.fromRGBO(246, 247, 215, 1)),
                      ),
                    ),
                  ),
                ],
              ),
            ],
          ),
        ),
      ),
    );
  }
}

Widget buildTextField(String labelText, String placeholder) {
  return Padding(
    padding: const EdgeInsets.only(bottom: 35.0),
    child: TextField(
      // obscureText: isPass ? showPass : false,
      decoration: InputDecoration(
          // suffixIcon: isPass
          //     ? IconButton(
          //         onPressed: () {},
          //         icon: Icon(Icons.remove_red_eye, color: Colors.grey),
          //       )
          //     : null,
          contentPadding: EdgeInsets.only(bottom: 3),
          labelText: labelText,
          labelStyle: TextStyle(
            fontSize: 14,
            // color: Colors.white,
          ),
          floatingLabelBehavior: FloatingLabelBehavior.always,
          hintText: placeholder, //ini lek mw ambil dr db ya bole
          hintStyle: TextStyle(
            fontSize: 16,
            color: Colors.grey.shade500,
          )),
    ),
  );
}
