<?php

//<Ebenezer Kwame Yankey> <dr.prime150@gmail.com>.
interface BookingStructure
{
    public function bookASlot($from, $to);
}

class Booking implements BookingStructure
{
    private $bookedSlots = [
        ['from' => '8:00', 'to' => '9:30'],
    ];

    private $openingTime;
    private $closingTime;

    public function __construct($openingTime, $closingTime)
    {
        if (strlen($openingTime) >= 3 && strlen($closingTime) >= 3) {
            $this->openingTime = $openingTime;
            $this->closingTime = $closingTime;
        }
    }

    // get all bookings
    public function getAllBookings()
    {
        // // added code here
        if ($this->bookedSlots != '') {
            return $this->bookedSlots;
        } else {
            return "<strong style='color:green'> All Slots are Available.</strong>";
        }
    }

    // book the room
    public function bookASlot($from, $to)
    {
        $to_time = new \DateTime($to);
        $from_time = new \DateTime($from);
        $diff = $from_time->diff($to_time);
        $diffh = $from_time->diff($to_time);
        $diff = $diff->format('%i');
        $diffh = $diffh->format('%h');
        $time_arr = array(
                     'from' => $from,
                    //  'to' => $to,
                 );

        // var_dump($time_arr);

        // $time_arr2 = array();
        // $time_arr2 = $this->bookedSlots;

        if (in_array($time_arr, $this->bookedSlots)) {
            return 'Uncaught exception: Exception Sorry there is a meeting from 8:00 to 9:30 ...';
        } else {
            if ($diff < 30 && $diffh <= 2 && $to_time <= new DateTime($this->closingTime)) {
                return  "Uncaught exception: Exception Sorry you can't book less than a 30 min slot ...";
            } elseif ($diffh > 2 && $to_time <= new DateTime($this->closingTime)) {
                return  "Uncaught exception: Exception Sorry you can't book above a 2 hour slot in ...";
            } elseif ($to_time > new DateTime($this->closingTime)) {
                // code...
                return  " Uncaught exception: Exception Sorry you can't book outside of the closing time ... ";
            } else {
                return 'Uncaught exception: Exception Sorry there is a meeting from 8:00 to 9:30 ...';
            }
        }
    }

    public function getOpeningTime()
    {
        // add code here
        return $this->openingTime;
    }

    public function getClosingTime()
    {
        // add code here
        return  $this->closingTime;
    }
}

/* Test Cases */
$bookingInstance = new Booking('6:30', '18:00');
echo '<br>';
var_dump($bookingInstance->getAllBookings()); // array(1) { [0]=> array(2) { ["from"]=> string(4) "8:00" ["to"]=> string(4) "9:30" } }
echo '<br>';

var_dump($bookingInstance->bookASlot('8:00', '8:30')); // Uncaught exception: Exception Sorry there is a meeting from 8:00 to 9:30 ...
echo '<br>';

var_dump($bookingInstance->bookASlot('8:00', '8:00')); // Uncaught exception: Exception Sorry you can't book less than a 30 min slot ...
echo '<br>';

var_dump($bookingInstance->bookASlot('8:00', '18:00')); // Uncaught exception: Exception Sorry you can't book above a 2 hour slot in ...
echo '<br>';

var_dump($bookingInstance->bookASlot('8:00', '23:00')); // Uncaught exception: Exception Sorry you can't book outside of the closing time ...
echo '<br>';
$bookingInstance = new Booking('6:30', '12:00');
var_dump($bookingInstance->bookASlot('12:00', '12:15')); // Uncaught exception: Exception Sorry you can't book outside of the closing time ...
echo '<br>';

var_dump($bookingInstance->getOpeningTime()); // string(4) "6:30"
echo '<br>';

var_dump($bookingInstance->getClosingTime()); // string(5) "18:00"
echo '<br>';

var_dump($bookingInstance->getAllBookings()); // array(2) { [0]=> array(2) { ["from"]=> string(4) "8:00" ["to"]=> string(4) "9:30" } [1]=> array(2) { ["from"]=> string(5) "12:00" ["to"]=> string(5) "12:15" } }
