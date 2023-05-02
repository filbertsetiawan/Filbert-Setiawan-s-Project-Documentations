import 'package:flutter/material.dart';
import 'package:flutter/src/widgets/container.dart';
import 'package:flutter/src/widgets/framework.dart';

class settingPageView extends StatefulWidget {
  const settingPageView({super.key});

  @override
  State<settingPageView> createState() => _settingPageViewState();
}

class _settingPageViewState extends State<settingPageView> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        margin: EdgeInsets.only(left: 30),
        child: Column(mainAxisAlignment: MainAxisAlignment.center, 
          children: [
            Text('This is setting page'),
            SizedBox(
              height: 30,
            ),
            ElevatedButton(
              onPressed: () {
                Navigator.pop(context);
              },
              child: Text('Back')
            ),
          ]
        ),
      ),
    );
  }
}

