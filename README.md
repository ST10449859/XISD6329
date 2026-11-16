FightClubSA – Booking & Membership Management System
XISD6329 – Final Work-Integrated Learning Project (Task 3)
Project Group: Project Guardians
Organisation: FightClubSA
Team Members
•	Siphesihle Mbeyiya – ST10449859
•	Dan Kabongo – ST10408413
________________________________________
1. Project Overview:
FightClubSA is a Booking and Membership Management System developed to improve the way a fitness organisation manages its members, fitness classes, bookings and other gym-related activities.
The project consists of two separate applications:
•	A PHP-based website.
•	An Android mobile application developed using Kotlin.
Both applications are designed to provide users with access to FightClubSA services while using backend services and a central MySQL database to manage information.
The system aims to improve organisation, accessibility, communication and the management of fitness club activities.
2. Purpose of the Application
The main purpose of FightClubSA is to provide a digital solution that simplifies gym operations and improves the experience of members and administrators.
The system addresses the challenges associated with manually managing membership information, class bookings, trainer schedules, attendance and payments.
Main Objectives:
•	Provide secure user registration and login.
•	Allow members to access fitness class information.
•	Support class bookings and booking management.
•	Provide access to membership information.
•	Manage payment-related information.
•	Support trainer and attendance information.
•	Provide notifications and user settings.
•	Offer access through both a website and Android application.
•	Store and manage information using a central database.
3. Main System Features:
Feature	Description:
Registration	Allows new users to create accounts.
Login	Allows registered users to access the system.
Dashboard	Provides access to important system information.
Classes	Displays available fitness classes.
Bookings	Supports class booking management.
Memberships	Provides membership-related information.
Payments	Supports payment information and records.
Trainers	Supports trainer information and management.
Attendance	Supports member attendance records.
Notifications	Provides a structure for important user updates.
Settings	Allows users to access their preferences.
The availability of individual functions depends on the implementation in the submitted application version.
4. Design Considerations:
The FightClubSA system was designed with usability, accessibility, security and consistency in mind.
4.1 User Interface Design
The website and Android application were designed to provide straightforward navigation and easy access to important functions.
The design considerations included:
•	Clear navigation menus.
•	Organised dashboard layouts.
•	Consistent page structures.
•	Readable text and clear labels.
•	Simple registration and login forms.
•	Mobile-friendly layouts and controls.
4.2 Website Design:
The website was developed using HTML, CSS, JavaScript and PHP.
It provides browser-based access to the FightClubSA system and organises the main functions into separate pages.
4.3 Android Application Design:
The Android application was developed using Kotlin and Android Studio.
Unlike a website displayed inside a WebView, the Android application is intended to operate independently with its own screens and navigation.
This provides a dedicated mobile experience for users.
4.4 Database Design:
MySQL was selected to provide structured storage for application information.
The database supports different areas of the system, including users, classes, bookings, memberships, payments and attendance.
4.5 Security Design:
Security considerations included:
•	Password hashing and verification.
•	Prepared SQL statements.
•	User authentication.
•	Token-based API authentication.
•	Input validation.
•	Protection of database credentials.
•	Access restrictions for protected functionality.
5. Technologies Used:
          Table:
Technology          Purpose
PHP                 Backend development and API functionality
MySQL               Database management
phpMyAdmin	        Database administration
HTML	              Website structure
CSS	                Website styling
JavaScript	        Website interactivity
Kotlin	            Android application development
Android Studio      Android development environment
XAMPP	              Local server environment
Visual Studio Code	Source-code editing
Git	                Version control
GitHub	            Source-code hosting and collaboration
GitHub Actions	    Automated development workflows, where configured

7. System Architecture:
The FightClubSA system uses a layered architecture consisting of client applications, backend services and a database.
Architecture Overview:
 FIGHTCLUBSA SYSTEM
               |
       -------------------
       |                 |
    WEBSITE          ANDROID APP
  HTML/CSS/JS          Kotlin
       |                 |
       -------------------
               |
         PHP BACKEND/API
               |
       -------------------
               |
          MYSQL DATABASE
               |
       APPLICATION DATA

How the System Works:
1.	A user accesses FightClubSA through the website or Android application.
2.	The application sends a request to the PHP backend.
3.	PHP processes and validates the request.
4.	The backend communicates with the MySQL database.
5.	The database retrieves or updates the requested information.
6.	The backend returns a response.
7.	The application displays the result to the user.
This architecture allows the website and mobile application to use shared backend functionality and centralised data storage.
7. Database Structure:
The FightClubSA database is named fightclubsa.
The database is managed through phpMyAdmin and uses MySQL.
The project database includes the following areas:
•	Users and account information.
•	User settings.
•	Fitness classes.
•	Bookings.
•	Memberships.
•	Payments.
•	Trainers.
•	Attendance.
•	Notifications.
•	API authentication tokens.
The final database structure should be checked against the submitted database to ensure that all table names are documented correctly.
8. Development Process:
The development of FightClubSA followed an iterative software development process.
Development Stages:
Stage 1: Planning
Requirements were identified, project objectives were established and responsibilities were allocated between team members.
Stage 2: Design
Sitemaps, wireframes, navigation structures and database requirements were prepared.
Stage 3: Website Development
The website was developed using PHP, HTML, CSS and JavaScript.
Stage 4: Android Development
A separate Android application was developed using Kotlin and Android Studio.
Stage 5: Backend and Database Integration
PHP backend services were connected to the MySQL database to support application functionality.
Stage 6: Testing
The website, database, authentication and mobile application were tested during development.
Stage 7: Documentation
Technical documentation, project reports, screenshots and release notes were prepared.
9. GitHub and Version Control:
Git and GitHub form part of the project's version-control approach.
Git is used to track changes made to project files, while GitHub provides an online platform for storing and managing source code.
How Version Control Supports FightClubSA:
•	Tracks changes made to application files.
•	Records development progress through commits.
•	Helps identify and resolve coding problems.
•	Maintains a history of project modifications.
•	Supports collaboration between team members.
•	Provides a central location for project source code.
Commit Management:
Meaningful commit messages help explain changes made during development.
Examples include:
•	Create FightClubSA website structure
•	Implement user registration and login
•	Connect PHP backend to MySQL
•	Develop Android application navigation
•	Update database functionality
•	Improve application interface
Version control helps maintain an organised development history and makes it easier to review project changes.
10. GitHub Actions and DevOps:
GitHub Actions is a workflow automation platform that can be used to automate software development activities.
For FightClubSA, GitHub Actions is relevant to the continuous integration and continuous delivery (CI/CD) process.
Intended GitHub Actions Workflow:
1.	A developer updates the application source code.
2.	Changes are committed and pushed to the repository.
3.	A configured GitHub Actions workflow can automatically start.
4.	The workflow can execute build and testing commands.
5.	Errors can be identified before a release.
6.	Successful changes can proceed through the deployment process where deployment is configured.
Benefits:
•	Reduces repetitive manual testing.
•	Helps identify errors earlier.
•	Supports consistent application builds.
•	Improves software quality.
•	Supports a more organised development process.
Implementation note: GitHub Actions automation should only be marked as implemented once a workflow file has been added and a successful workflow run can be demonstrated. The workflow described above represents the intended CI/CD process, not proof of a completed automated deployment.
11. Testing and Quality Assurance:
Testing was performed during development to identify problems and check the operation of the system.
The development documentation recorded the following checks:
Test	Recorded outcome:
                        Table:
Starting Apache and MySQL           Successful
Opening the website locally         Successful
Database connection                 Successful
Identifying database tables         Successful
User registration                   Reported working
User login                          Reported working
Android APK build                   Previously built successfully
Membership information retrieval    Required further investigation in Task 2
Physical-device connectivity        Required further investigation in Task 2

Further testing should be performed against the final submitted build to confirm that the earlier issues have been resolved.
13. Release Notes:
The release notes describe the changes made to FightClubSA as the project developed from its initial prototype into the expanded website and Android application.
Version 1.0 – Initial Prototype
The initial project design established the foundation for the FightClubSA management system.
Initial planned functionality included:
•	User registration and login.
•	Member dashboard.
•	Fitness classes.
•	Class bookings.
•	Membership information.
•	Booking history.
•	Trainer information.
•	Administrative functions.
Version 2.0 – Enhanced Development
The project was expanded to provide a more complete system design and implementation.
Updates included:
•	Expanded website functionality.
•	Development of PHP backend services.
•	MySQL database integration.
•	Improved registration and login implementation.
•	Additional website pages.
•	Improved application navigation.
•	Database support for membership and fitness-club operations.
•	Development of the Android application.
Version 3.0 – Final Project Development
The final development stage focused on bringing the website, Android application and database together.
Updates and improvements included:
•	Development of a separate Android application using Kotlin.
•	Independent mobile application navigation and screens.
•	Expanded database structure.
•	Improved backend/API integration.
•	Authentication and token-based API functionality.
•	Improved organisation of website and mobile application components.
•	Additional database operations.
•	Continued testing and troubleshooting.
•	Updated technical documentation.
Innovative Features Added
The main innovative improvements introduced during the later development stages include:
1. Dual-platform access
Members can access the FightClubSA system through a website or a dedicated Android application.
2. Shared backend architecture
The website and Android application are designed to communicate with backend services and centralised database storage.
3. Centralised database management
MySQL provides structured storage for important fitness-club information.
4. Mobile application experience
The standalone Android application provides a dedicated mobile interface rather than simply displaying the website.
5. API-based communication
PHP backend endpoints provide a structured way for client applications to communicate with the system.
6. Improved authentication approach
Password hashing, password verification and token-based authentication support the protection of user accounts and API operations.
These improvements represent the main development enhancements beyond the original prototype design.
13. Future Improvements
Possible future enhancements include:
•	Automated booking confirmation notifications.
•	Online payment gateway integration.
•	Improved attendance reporting.
•	Advanced administrator dashboards.
•	Trainer schedule management.
•	Automated testing through GitHub Actions.
•	Cloud hosting and production deployment.
•	Improved analytics and reporting.
•	Additional mobile application functionality.
14. Conclusion:
FightClubSA demonstrates the development of a booking and membership management system that combines web development, Android application development, backend programming and database management.
The project provided practical experience in PHP, MySQL, Kotlin, Android Studio, API development, software testing and version control.
The combination of a website and a standalone Android application provides different ways for users to access the system while maintaining a shared backend and database architecture.
Overall, FightClubSA establishes a foundation for improving fitness-club administration, member accessibility and the management of important gym activities.


