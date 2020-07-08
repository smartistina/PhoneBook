# OVERVIEW
You want to create a simple web application that allows you to manage an address book. The application consists of a web part of frontend and stores the data on a database.
# FUNCTIONALITY
1. The address book must allow you to list, enter and edit simple master data sheets
2. Hypothetically, the application consists of a minimum of two pages, one containing the list of entities contained in the address book and one allowing the insertion/modification of an entity.
# SPECIFICATIONS
Each entity in the registry (card) must contain the following fields:
Name
Surname
Date of Birth
ZIP code of residence
Email address
Each name may be associated with one or more telephone numbers, each of which is composed of:
Address type
Delivery number
It is necessary to correctly implement the validation of the data both in terms of their presence (mandatory) and format.
The application must implement both database access and data and functionality management through a set of classes. As far as the definition of the tables is concerned, choose on the database the type of data that you consider most appropriate in relation to the information to be managed.
 The application should not be based on external libraries or frameworks. It must also be compatible with PHP version 5 (bonus if compatible with PHP version 5.1).
Security aspects (prevention of XSS attacks, SQL Injection, etc.) will also be evaluated.
