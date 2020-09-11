<?php


namespace victor\training\oo;




//(new Tata())->portofel();
(new Fiu())->mergiLaBar();
(new Fiica())->mergiLaSalon();


abstract class Tata {
    function portofel() {
//        throw new \Exception("Nu-ti dau");
        $this->metChemata();
    }
    function metChemata() {
        echo "Sun-o pe mama \n";
    }
}
abstract class Tata00 {
    function portofel() {
//        throw new \Exception("Nu-ti dau");
        $this->metChemata();
    }
    function metChemata() {
        echo "Sun-o pe mama \n";
    }
}


class Nepot extends Tata {
    //
}
class Fiica extends Tata {
    function cereBani() {

    }
    function mergiLaSalon() {
        $this->portofel();
    }
}

class Fiu extends Tata {
    private Tata $tata;
    function cereBani() {

    }
    function mergiLaBar() {
        $this->portofel();
    }
    public function metChemata()
    {
        echo "8989989\n";
    }
}

abstract class MessageProcessor {
    private ConfirmationStrategy $confirmationStrategy;
    //
}
interface ConfirmationStrategy {

}
class Ack implements ConfirmationStrategy{}
class NoAck implements ConfirmationStrategy{}

class PlaceOrderMessageProcessor {

}
class PlaceOrderMessageProcessorWithAck {

}
class ShipOrderMessageProcessor {

}
class ShipOrderMessageProcessorWithAck {

}