Magic methods in PHP are special methods that start with a double underscore (`__`) and are predefined by the PHP engine. These methods allow you to define custom behaviors for specific actions performed on objects, such as accessing properties, invoking methods, or serializing objects. They are called automatically by PHP when certain events occur.

---

### Common Magic Methods in PHP (with Examples)

#### 1. **`__construct()`**

- Called automatically when an object is created.
- Used for initialization.

**Example:**

```php
<?php
class User {
    public $name;

    public function __construct($name) {
        $this->name = $name;
    }
}

$user = new User("Apurv");
echo $user->name; // Outputs: Apurv
?>
```

---

#### 2. **`__destruct()`**

- Called automatically when an object is destroyed or script execution ends.
- Often used for cleanup tasks.

**Example:**

```php
<?php
class Logger {
    public function __destruct() {
        echo "Cleaning up resources.";
    }
}

$logger = new Logger();
// When the script ends, the message is printed: Cleaning up resources.
?>
```

---

#### 3. **`__get($name)`**

- Called when accessing a property that doesn’t exist or is inaccessible.

**Example:**

```php
<?php
class User {
    private $data = ["email" => "apurv@example.com"];

    public function __get($name) {
        return $this->data[$name] ?? "Property not found!";
    }
}

$user = new User();
echo $user->email; // Outputs: apurv@example.com
echo $user->name;  // Outputs: Property not found!
?>
```

---

#### 4. **`__set($name, $value)`**

- Called when setting a value to a non-existing or inaccessible property.

**Example:**

```php
<?php
class User {
    private $data = [];

    public function __set($name, $value) {
        $this->data[$name] = $value;
    }
}

$user = new User();
$user->email = "apurv@example.com";
?>
```

---

#### 5. **`__call($name, $arguments)`**

- Called when invoking a non-existing or inaccessible method.

**Example:**

```php
<?php
class Calculator {
    public function __call($name, $arguments) {
        if ($name === "add") {
            return array_sum($arguments);
        }
        return "Method not found!";
    }
}

$calc = new Calculator();
echo $calc->add(5, 10); // Outputs: 15
?>
```

---

#### 6. **`__toString()`**

- Called when an object is treated as a string (e.g., in `echo`).

**Example:**

```php
<?php
class User {
    public $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function __toString() {
        return "User: " . $this->name;
    }
}

$user = new User("Apurv");
echo $user; // Outputs: User: Apurv
?>
```

---

#### 7. **`__clone()`**

- Called when an object is cloned.

**Example:**

```php
<?php
class User {
    public $name;

    public function __clone() {
        $this->name = "Cloned " . $this->name;
    }
}

$user1 = new User();
$user1->name = "Apurv";

$user2 = clone $user1;
echo $user2->name; // Outputs: Cloned Apurv
?>
```

---

#### 8. **`__isset($name)`**

- Called when `isset()` or `empty()` is used on inaccessible or non-existing properties.

**Example:**

```php
<?php
class User {
    private $data = ["email" => "apurv@example.com"];

    public function __isset($name) {
        return isset($this->data[$name]);
    }
}

$user = new User();
var_dump(isset($user->email)); // Outputs: bool(true)
?>
```

---

#### 9. **`__unset($name)`**

- Called when `unset()` is used on inaccessible or non-existing properties.

**Example:**

```php
<?php
class User {
    private $data = ["email" => "apurv@example.com"];

    public function __unset($name) {
        unset($this->data[$name]);
    }
}

$user = new User();
unset($user->email);
?>
```

---

#### 10. **`__invoke()`**

- Called when an object is used as a function.

**Example:**

```php
<?php
class CallableObject {
    public function __invoke($message) {
        return "Message: " . $message;
    }
}

$obj = new CallableObject();
echo $obj("Hello, Apurv!"); // Outputs: Message: Hello, Apurv!
?>
```

---

#### 11. **`__sleep()` and `__wakeup()`**

- Used during serialization (`serialize()` and `unserialize()`).
- `__sleep()` specifies properties to serialize.
- `__wakeup()` is called upon deserialization.

---

#### 12. **`__debugInfo()`**

- Customizes what is shown when using `var_dump()` on an object.

**Example:**

```php
<?php
class User {
    private $data = ["email" => "apurv@example.com"];

    public function __debugInfo() {
        return ["debug_email" => $this->data["email"]];
    }
}

$user = new User();
var_dump($user); // Outputs: array(1) { ["debug_email"]=> string(18) "apurv@example.com" }
?>
```

---

### Summary Table

| Magic Method    | Trigger                               | Use Case Example                 |
| --------------- | ------------------------------------- | -------------------------------- |
| `__construct()` | When object is created                | Initialization                   |
| `__destruct()`  | When object is destroyed              | Cleanup                          |
| `__get()`       | Accessing inaccessible properties     | Dynamic property resolution      |
| `__set()`       | Setting inaccessible properties       | Dynamic property assignment      |
| `__call()`      | Calling inaccessible methods          | Method overloading               |
| `__toString()`  | Object treated as string              | Custom string representation     |
| `__clone()`     | Cloning an object                     | Modify cloned object             |
| `__invoke()`    | Object used as a function             | Callable objects                 |
| `__isset()`     | Using `isset()` on inaccessible props | Dynamic property existence check |
| `__unset()`     | Using `unset()` on inaccessible props | Dynamic property deletion        |
