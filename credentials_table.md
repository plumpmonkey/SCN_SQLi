# Credentials Table

| ID  | Name    | EID | Salary | Birth | NationalInsuranceNo | PhoneNumber | Email | Password (Plaintext) |
| --- | ------- | --- | ------ | ----- | ------------------- | ----------- | ----- | -------------------- |
| 1   | Alpha   | 10  | 80000  | 10/07 | NB12746325B         |             |       | Alpha                |
| 2   | Bravo   | 20  | 75000  | 20/04 | DA83762163V         |             |       | Bravo                |
| 3   | Charlie | 30  | 40000  | 01/08 | JC834645277B        |             |       | Charlie              |
| 4   | Delta   | 40  | 90000  | 11/01 | EF2747556298A       |             |       | Delta                |
| 5   | Ethan   | 50  | 55000  | 11/03 | OP63624164B         |             |       | Ethan                |
| 6   | Faraday | 60  | 50000  | 23/02 | JY2734827C          |             |       | Faraday              |
| 7   | Admin   | 99  |        |       |                     |             |       | uwe                  |

# Connect to mysql running in docker (Password: uwe)

mysql -u root -p -h 127.0.0.1 -P 3306
