# Project 2 - Currency Converter
+ By: Daniel McCullough
+ Production URL: <http://p2.beachboffin.com>

## Outside resources
I referred a bit to Stack Exhange for information to figure out why particular behaviors/errors were occurring (see below), but no particular code was referenced.  The URL and JSON use information came from php.net.

## 3 Unique inputs

1. Text input for the currency amount that is to be converted.
2. Dropdown for current currency selection.
3. Dropdown for target currency selection.
4. Checkbox for user to choose rounding option.

## Class
Converter.php - A class used to convert from the current currency to the target currency.  Also creates the array of conversion values.

MyForm.php - A class thet extends the Form.php class.  It overrides the "validate" method to allow for the error message to refer to the field by a name that is specified.  The array the method receives is of the following form:
```php
$errors = $form->validate(
    [
        ['amount', 'amount', 'required|numeric|min:0']
    ]);
```
It just so happens in this case that the name of the field is the same as the name displayed in the error message.

## Code style divergences
I'm not aware of any divergences.  I made sure to do a "format code" in PHPStorm.

## Notes for instructor
I usually don't like to rely on a session object to store data, but I did store the conversion rates to avoid too many calls to the conversion rate web service.  Initially, the conversion rates were a property of the Converter, and I was actually storing the entire Converter object.  This was working fine at first, then I started getting a "_PHP_Incomplete_Class" object when retrieving the object from the session.  I discovered after a bit of investigation on Stack Exchange that storing objects in that way is "dodgy" (https://stackoverflow.com/questions/9402028/cache-or-store-in-session). I looked into other options such as making the class Serializable or using "memcache," but I think the best solution was to separate the currency rates array from the Converter class and just store the array.  This turned out to be much more reliable.   
