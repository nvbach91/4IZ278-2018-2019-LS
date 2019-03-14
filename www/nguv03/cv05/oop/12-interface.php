<?php
/**
 * Interface je jakoby protokol. Jen říká, která chování by měly objekty mít.
 * Ale už ne říká, jaká jsou. Jinými slovy interface nám umožňuje nadefinovat
 * které metody třída musí naimplementovat, aniž abychom musely tyto metody
 * přímo naimplementovat
 * 
 */

interface Device {
    // all methods in an interface must be public
    public function switchOn();
    public function switchOff();
}

interface Volume {
    public function volumeUp();
    public function volumeDown();
}

// Must implement all methods from the interface(s)
class CellPhone implements Device, Volume {
    public function switchOn() {
        echo "Switched On", '<br>';
    }
    public function switchOff() {
        echo "Switched off", '<br>';
    }
    public function volumeUp() {
        echo "Volume Up", '<br>';
    }
    public function volumeDown() {
        echo "Volume Down", '<br>';
    }
}

$cellPhone = new CellPhone();
$cellPhone->switchOn();
$cellPhone->volumeUp();
$cellPhone->volumeDown();
$cellPhone->switchOff();


/**
 * Např. zde chceme rozdělit činnosti do více skupin
 */
interface MovingAction {
    public function walk();
    public function run();
}
interface VerbalAction {
    public function talk();
    public function speak($language);
}
/**
 * A pak sloučit je do jednoho, kde nadefinujeme něco navíc
 */
interface Action extends MovingAction, VerbalAction {
    public function act();
}
/**
 * A pak to použít ve třídě, kde to všechno musíme specifikovat
 */
class Human implements Action {
    public function walk() {
        echo "I'm walking", '<br>';
    }
    public function run() {
        echo "I'm running", '<br>';
    }
    public function talk() {
        echo "I'm talking to you", '<br>';
    }
    public function speak($language) {
        echo "I'm speaking in $language", '<br>';
    }
    public function act() {
        echo "I'm acting", '<br>';
    }
}

$human = new Human();
$human->walk();
$human->run();
$human->talk();
$human->speak("English");
$human->act();

?>