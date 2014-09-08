#Inpost API Wrapper
======

##Installation
Please run 
```
php composer update
```
after you clone the repo

##Some features

You can extend any class any where for example

```
/**
 * Controller method action
 */
public function showCustomer() {
	
	$inpostApi = InpostApi::getInpostModel();
	$inpostApi->extend('stdClass'); // this could be anythig
	$inpostApi->name = 'John';
	echo $inpostApi->name;

}

```

You have view Presenter to present you data in better way

```

public function presentLink()
{
	$url = $this['url'];
	$name = $this['name'];

    return "<a href='".$url."'>".$name."</a>;
}


```

##TODO
* Event should be fired after some action (eg. new parcel created)

##ISSUE
Code is not tested because API was down or returned weird responses
