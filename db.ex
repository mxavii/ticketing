FLight ticketing

Flight_timetable
-id
-airline_id
-airport_from_id
-airport_to_id
-departure_date
-departure_time
-arrival_date
-arrival_time

Fare_schedules
-id
-Flight_timetable_id
-fare

Airline
-id
-airline_name
-flight_code

Airport/
-id
-code
-tax

Ticket
-id
-customer_id
-fare_schedules_id
-issued

Agen/
-id
-username
-password

Passenger
-id
-name
-phone
-email
-addres

Auth
-id
-agen_id
-key
-expired
