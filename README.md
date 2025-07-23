<img width="200" height="150" alt="Unbenannt-1" src="https://github.com/user-attachments/assets/8b49b952-2ed6-466f-b7e1-99571dff6cb5" />

# Final Engineering Project: Smart Home System

This project was developed as part of my final engineering thesis during my apprenticeship as an information technician at Evangelisches Gymnasium und Werkschulheim in Austria.

➡️ For the full documentation of this thesis find the file [Full Project Documentation.pdf](https://github.com/user-attachments/files/21316378/Full.Project.Documentation.pdf)

➡️ For a quick overlook of the project in form of a user manual find the file [User Manual.pdf](https://github.com/user-attachments/files/21389679/User.Manual.pdf)


## Objective

In a household, there are many small handles, such as switching on a lamp or a power distribution, which are usually dispersed throughout the apartment. This project centralizes all these physical switches in one web application.

The web application should be compatible with various smartphones as a host device. The graphical layout and position of the menu bar and buttons of the website adapts to the screen resolution of the host device. Thus, the user interface looks the same for all application devices and there are no compatibility issues due to a low / high display resolution of a smartphone or tablet.

The user interface provides the user with an area for each switching option of a device registered in the system, in which he can assign the device the desired status. There are two actions available for each item; the switch-on and switch-off command. Tapping on one of the action buttons a 433-mHz-radio signal is transmitted to the corresponding device by a microcontroller equipped with a radio module. Depending on the radio signal, the radio devices can react with two actions: the device is switched off or switched on.

A new lamp or socket can be added through a database entry. For each device name, there are two entries in the database table; the signal for a switch-on and switch-off action.

The web application differentiates in the menu navigation between the control of a light and that of a device. The individual menu tabs can be scrolled through on a smartphone with finger wipes or by tapping on a menu item.

To save several operations, several devices, such as all garden or dining table lights, can be assigned to a group. Thus, in addition to the individual control options, the user can operate the devices of an entire logical area of an apartment with a single touch.

The connection to the interface can be established at any time through a browser window of a smartphone, which is located in the same network. For access to the control of the lights and sockets of the apartment a network access in the form of a Wi-Fi password or a physical connection to the network is needed.

## Motivation

To find my engineering project, I asked myself how I could combine everyday things with the help of data processing. I quickly thought of the operation of light switches. Sometimes I wish there was a universal remote control so that I could switch lights and devices on and off without having to leave the couch. Or when you've just left the house and you're not sure if all the lights are switched off to save electricity.
Once I knew what I wanted to achieve with the project, I asked myself how I could implement it. I realized that there are an infinite number of ways to realize such a project. For the realization of the project, I decided on those technologies in which I was personally interested and already had a cer-tain amount of prior knowledge.  As we only studied programming languages such as PHP, JavaScript or SQL superficially in class, I first had to acquire a lot of knowledge about them myself.

## Introduction
The project can be divided into 4 main chapters: Programming the web application, setting up the web server, preparing the database and configuring the microcontrollers.

I decided to start the project with the configuration of the NodeMCU ESP8266 microcontroller from AZDelivery. However, before this can be connected to a computer for transferring program code, the Arduino development environment must be installed and configured. After connecting a 433 MHz receiver module to the GPIO ports of the microcontroller, the radio code parameters of the individual radio-controlled lamp holders and radio-controlled sockets can be determined using the remote con-trols supplied and recorded in an Excel spreadsheet in the meantime.

<img width="356" height="487" alt="image" src="https://github.com/user-attachments/assets/8c24aea8-826b-4c3c-8e8c-f18585e69caa" />

Once the radio codes of each radio device have been determined, the radio receiver module can be removed again and replaced by a radio transmitter. To be able to respond to incoming http requests, a small web server must be installed on the microcontroller. This web server can extract radio pa-rameters from an http request tailored to the project, which it can then send out via the radio trans-mitter. In this way, it is possible for every network-compatible device in the same network to com-mand the microcontroller to send out a certain radio signal using a curl function.

The second main chapter of the project will deal with the configuration of the Raspberry Pi server. First, the Raspbian operating system optimized for the Pi must be installed on its MicroSDHC card.  An Apache2 server is then installed as a web server, MySQL as a database system and a Php inter-preter on the Linux distribution using a terminal command.

Once all the settings have been made in the Raspberry Pi operating system, the database structure for the transmission codes can be created using the phpMyAdmin tool. The project's database only requires one table called “codes”. One row of the table contains information about the name of the device, the radio parameters (protocol number, pulse length and pulse value), the action that triggers the signal (on or off) and the category of the device (either a lamp or socket). The signal codes from the previously created Excel table can now be entered into the database. There are two entries for each device name: one with the “on” action and one with the “off” action.

<img width="1661" height="905" alt="image" src="https://github.com/user-attachments/assets/ccc9f158-3839-44e5-8284-41cc3f3e2b00" />


When the database is ready for retrieval, the last main chapter of the project can begin: The programming of the web application. As the website should be responsive, the CSS file does not contain absolute values, but values relative to the viewport. This means that the menu is displayed in the same proportions on smartphones with different screen resolutions.

The menu is programmed using JavaScript. With normal JavaScript code and jQuery, the website is divided into menu tabs. These tabs can be scrolled through on a smartphone with the help of a script using a swipe gesture. A tap on the respective menu item is also sufficient to switch to the content of this tab.

As the web application is to be built dynamically depending on the database entries, the code is in a php file. Using Php as a scripting language, database entries can be entered and displayed as an ele-ment on the website. The term element refers to the button of a radio device. The button of a radio offers the user two actions: Switching the device on and off.

<img width="1654" height="921" alt="image" src="https://github.com/user-attachments/assets/27567e8f-ec64-4527-88cd-0d58804bf152" />


## Conclusion
The development of the “Home Control” project challenged me in many ways and I encountered some problems during the written formulation. I really enjoyed the process of solving these unexpected problems, knowing that the project would become better and more perfect with every problem solved or work step simplified. I can proudly say that I worked out and developed the theoretical and practical part of the engineering project completely independently with the help of the sources provided. 
My project supervisor, Professor Berger, drew my attention to certain standards that I was not familiar with in the course of the written elaboration. Solving these problems showed me that there is usually not just one way to implement a new function or query in a system or to connect two sys-tems with each other.
Furthermore, the technician project not only gave me valuable experience, but also a product that I can use in my everyday life. Thanks to the written elaboration, I will probably never forget how “Home Control” works and is structured.
Planning the whole project from scratch and finding ways to connect different technologies that were initially incompatible also taught me a lot. It has shown me that it is better to build bridges between existing technologies than to have to reinvent the wheel in complete isolation from every-thing else. Many processes in one system can be transferred to another, where they can then be pro-cessed further.

## References
Source 1: https://tutorials-raspberrypi.de/nodemcu-esp8266-433mhz-funksteckdosen-steuern/
Source 2: https://www.instructables.com/id/Using-an-ESP8266-to-Control-Mains-Sockets-Using-43/
Source 3: https://arduino-hannover.de/2015/04/08/arduino-ide-mit-dem-esp8266/
Source 4: https://www.raspberrypi.org/
Source 5: https://www.raspbian.org/
Source 6: https://httpd.apache.org/
Source 7: https://searchoracle.techtarget.com/definition/MySQL
Source 8: https://www.heise.de/download/product/win32-disk-imager-92033
Source 9: https://jankarres.de/2012/08/raspberry-pi-raspbian-installieren/
Source 10: https://www.raspberrypi.org/documentation/remote-access/web-server/apache.md
Source 11: https://www.stewright.me/2012/09/tutorial-install-phpmyadmin-on-your-raspberry-pi/
Source 12: https://askubuntu.com/questions/763336/cannot-enter-phpmyadmin-as-root-mysql-5-7
Source 13: https://www.w3schools.com/css/css_rwd_viewport.asp
Source 14: https://css-tricks.com/snippets/css/a-guide-to-flexbox/
Source 15: https://www.w3schools.com/jquery/jquery_get_started.asp
Source 16: https://stackoverflow.com/questions/2264072/detect-a-finger-swipe-through-javascript-on-the-iphone-and-android
Source 17: https://stackoverflow.com/questions/10734396/how-to-launch-php-file-from-javascript-without-window-open
Figures 1-6 and 9-23: own illustration
Figure 7: https://www.amazon.de/gp/product/B0798SWCBC/ref=oh_aui_detailpage_o02_s00?ie=UTF8&psc=1 [last access: 24.12.2018]
Figure 8: https://www.amazon.de/gp/product/B009VCZUQC/ref=oh_aui_detailpage_o00_s00?ie=UTF8&psc=1 [last access: 24.12.2018]

