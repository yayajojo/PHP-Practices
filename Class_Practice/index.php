<?php
//class practice ->instationate -> object

class Team
{
 protected $name;

 protected $members;

 public function __construct($name,$members=[])
 {
     $this->name = $name;
     $this->members = $members;
 }

public static function create($name,$members=[]){
  return new static($name,$members);
}

public static function build(...$params){

  return new static(...$params);

}

 public function add($name)
 {
   $this->members[] = $name; 
 }


}

class Member
{
  protected $name;
  public function __construct($name)
  {
    $this->name = $name;
  }
}


//
$acam = new Team("acam");
$acam->add('Lisa');

//static class method to create an object
$berry = Team::create("berry",[new Member("Jhao"), new Member("Mary")]);

//spread operator
$cherry = Team::build("cherry",["Jhao","Mary"]);

//var_dump($cherry);
//var_dump($acam);
var_dump($berry);



// Inheritance: is a relationship: use extends

// basic example: CoffeeMaker & SpecialCoffeeMaker

class CoffeeMaker 
{

  protected $sugar;

  public function __construct($sugar)
  {
    $this->sugar = $sugar;
  }
  public function brew()
  {
    die("brewing an American coffee with $this->sugar");
  }
}


class SpecialCoffeeMaker extends CoffeeMaker
{
 public function __construct($sugar,$milk)
 {
   parent::__construct($sugar);
   /*
   if child class has its own constructor, it will need
   to call parent class's contructor
   */
  $this->milk = $milk;
 }
 public function brewLatte()
 {
   die("brewing a latte");
 }

}

(new SpecialCoffeeMaker('sugar','milk'))->brew();
(new SpecialCoffeeMaker('sugar','milk'))->brewLatte();

class Collection
{
  protected $items;

  public function __construct(array $items)
 {
   $this->items = $items;
 }

 public function sum($key){
   return 
   array_sum(
     array_column( $this->items,$key)
   );
  }
}

/*array_map(function ($value) use (&$an_array ) {
  $an_array [$value] = (boolean)$an_array [$value];   //example operation:
}, $items_to_modify);
*/


class VideoCollection extends Collection
{
  public function length()
  {
    return $this->sum('length');
  }
}


$collection = new VideoCollection([new Video('New',200), new Video('ma',300)]);
echo $collection->length("length");

class Video
{
  public $tilte;
  public $length;

  public function __construct($title,$length)
  {$this->title = $title;
  $this->length = $length;
  }
  public function length()
  {
    return $this->length;
  }
}




//abstract class && abstract methods used for: common template
//abstract methods should be implemented in children classes

abstract class AchievementBadge
{


public function name()
{
$className = (new ReflectionClass($this))->getShortName();
$name = preg_replace('/[A-Z]/'," $0",$className);
//$0 represent replaced variable
return $name;

}  

public function icon()
{
$icon = strtolower(preg_replace('" "', '-',$this->name().'.png'));
return $icon;
}

abstract function qualifier();


}


class FirstThousandPoints extends AchievementBadge
{
public function qualifier()
{
  
}
}

class HeroOfToday extends AchievementBadge
{

  public function qualifier()
  {
    
  }
}


echo (new FirstThousandPoints())->icon();


function printName( AchievementBadge $name)
{
echo $name->name();
}

//printName(new FirstThousandPoints);

Class Mother
{
 public function name()
 {
   echo 'mama';
 }

}

printName(new HeroOfToday);





//interface: contract for class implementing this interface




interface iNewsLetter
{

public function subscribe($message);

}



class NewsCompaign implements iNewsLetter
{

public function subscribe($message)
{
echo $message;
}

}




class Drip implements iNewsLetter
{

  public function subscribe($message)
  {
  echo 'Subscribe newsletter by '.$message;
  }

}




class NewsLetterCompaign
{

public function compaign(iNewsLetter $newsLetter,$email)
{

$newsLetter->subscribe($email);

}

}




(new NewsLetterCompaign())->compaign(new NewsCompaign(),'fleeting@gmail.com');
(new NewsLetterCompaign())->compaign(new Drip(),'fleeting@gmail.com');

// Composition: has a relationship

interface BillServiceProvider
{
  public function auth($user);

}


class StriprGateway implements BillServiceProvider
{
  public function auth($user){
    echo "Already find user $user by stripe";
  }

}

class WorldPress implements BillServiceProvider
{
  public function auth($user){
    echo "Already find user $user by worldpress";
  }

}

class Subscription
{
protected $user;

protected $bsp;

public function __construct(BillServiceProvider $bsp, $user)
{
$this->bsp = $bsp;
$this->user = $user;
}

public function cancel()
{
  //$this->bsp->auth($this->user);
  var_dump(new static(new WorldPress(),'Static'));
}

public static function change()
{
  var_dump(new self(new WorldPress(),'SLEF'));
}

}




//(new Subscription(new StriprGateway(),'YAYA'))->change();
(new Subscription(new WorldPress,'JHAO'))->cancel();


//Vaule objects and mutability
// reference:: https://codete.com/blog/value-objects/
/**
 * Readability – the types of things that we pass to different parts of our application match to what they represent in our domain and it’s clearer what kind of value is expected without having to check in the code
 * Validation – every existing value object is in a correct state. This means that we don’t have to check them when we use them (of course they still need to conform to our business rules)
 * Type hinting (for PHP < 7.0) – while in PHP 7.0+ we can type hint primitive types for parameters, it’s only possible for class types (which VOs are in PHP) in older versions
 * Immutability – value objects’ definition doesn’t require them to be immutable, but in practice immutability is needed… which is great, because immutability brings thread safety and makes the code easier to reason about (which means less bugs)
*/

class Money
{
  private $amount;
  private $currency;
  public function __construct(int $amount, String $currency)
{
  $this->amount = $amount;
  $this->currency = $currency;
 if ($amount <0 )
 { throw 
  new InvalidArgumentException('Please enter positive value');
 }elseif(strlen($currency) !== 3){
  throw 
  new InvalidArgumentException('Please enter correct currency');
 }
}

 public function increment($addedAmount) {
   return new self($this->amount+$addedAmount, $this->currency);//immutability
   // $this->amount += $addedAmount; // mutability
 }


public function getAmount(){
  return $this->amount.' '.$this->currency;
}

}
class Invoice
{
  protected $user;
  protected $price;

  public function __construct(String $user, Money $price)
  {
    $this->user = $user;
    $this->price = $price;
  }
 public function getPrice()
 {
   return $this->price->getAmount();
 }
 public function getUser()
 {
   return $this->user;
 }

}




try{
  $firstBill = new Money(-200,'USD');
//$firstBill->increment(500);//mutability
  $secondBill = $firstBill->increment(500);//immutability
  $invoice = new Invoice('Jhao',$firstBill);
  echo $invoice->getPrice();
  // $invoice = new Invoice('Jhao',$secondBill);
  // echo $invoice->getPrice();

}catch(InvalidArgumentException $e)
{
  echo $e->getMessage();
}


//$this: instantiated object; 
//self/static: class->self(who owns the method)/static(who calls the method)
// parent: parent::_construct(params)->parent class
class A
{
static $name = 'A';
public static function name()
{echo static::$name;
} 
public static function selfName()
{echo self::$name;
} 
}


class B extends A
{
static $name = 'B';

}


B::selfName();//A

B::name();//B


// try and catch exception: 




















