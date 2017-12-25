This project is for the food distribution system of the Akshaya Patra Foundation.

The routes table will have school_id as the array of ids of the schools for a particular route.
So the first and second loops will run only once.

So, for the drivers dashboard, i have taken the school id from the school id array in the routes
table and then used that to get the name of that school and simultaneously checked whether that school id
is there in the delivery time table or not. If the school id is present in the delivery time table then
that means either the driver or the school principal has entered the delivery time. Then i have checked
the driver c time, if that is null then the school name will be displayed. If all this is false and the
school name is not there in the delivery time table, then also the school will be displayed. In short the
only time the school name will not be displayed is when the driver has entered the driver_ctime. (Rohit)

EDIT: In drivers.php, first the school_id and date of delivery will be checked, and accordingly the data will
be filled in the respective fields. If the date will be clashed b/w the driver and principal only then it will
be reported to either of them.
