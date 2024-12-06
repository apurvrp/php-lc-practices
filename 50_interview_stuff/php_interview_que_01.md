### List of PHP interview questions for experienced developers, along with answers and practical examples:

---

### **1. What are PHP Traits, and why are they used?**

**Answer:**  
Traits are a mechanism for code reuse in PHP. They allow you to include methods from a trait into a class, avoiding multiple inheritance limitations.

**Example:**

```php
trait Logger {
    public function log($message) {
        echo "Logging message: $message";
    }
}

class User {
    use Logger;
}

$user = new User();
$user->log("User created."); // Output: Logging message: User created.
```

---

### **2. Explain the difference between `require` and `include`.**

**Answer:**

- **`require`**: If the file is not found, it produces a fatal error, and the script stops executing.
- **`include`**: If the file is not found, it produces a warning, and the script continues executing.

**Example:**

```php
require 'nonexistent.php'; // Fatal error

include 'nonexistent.php'; // Warning, but the script continues
```

---

### **3. How do you prevent SQL Injection in PHP?**

**Answer:**  
You can prevent SQL Injection by using prepared statements and parameterized queries with PDO or MySQLi.

**Example with PDO:**

```php
$pdo = new PDO('mysql:host=localhost;dbname=testdb', 'user', 'password');
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$stmt->bindParam(':username', $username);
$username = 'john_doe';
$stmt->execute();
$results = $stmt->fetchAll();
```

---

### **4. What are Magic Methods in PHP? Can you give some examples?**

**Answer:**  
Magic methods are special methods in PHP that start with `__` (double underscore). They are triggered automatically in certain conditions.

**Examples:**

- `__construct()`: Called when an object is created.
- `__destruct()`: Called when an object is destroyed.
- `__get()`: Handles inaccessible property access.
- `__set()`: Handles setting values to inaccessible properties.

**Practical Example:**

```php
class User {
    private $data = [];

    public function __set($name, $value) {
        $this->data[$name] = $value;
    }

    public function __get($name) {
        return $this->data[$name] ?? null;
    }
}

$user = new User();
$user->name = 'Apurv';
echo $user->name; // Output: Apurv
```

---

### **5. How do you handle file uploads in PHP?**

**Answer:**  
Use the `$_FILES` superglobal to manage file uploads.

**Example:**

```php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["file"]["name"]);

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        echo "The file " . htmlspecialchars(basename($_FILES["file"]["name"])) . " has been uploaded.";
    } else {
        echo "Error uploading file.";
    }
}
```

---

### **6. What is the difference between `abstract class` and `interface`?**

**Answer:**

- **Abstract Class**: Can contain both abstract methods and concrete methods.
- **Interface**: Can only contain method declarations (PHP 8+ allows default implementations).

**Example:**

```php
abstract class Animal {
    abstract public function sound();
    public function eat() {
        echo "Eating food.";
    }
}

interface Flyable {
    public function fly();
}

class Bird extends Animal implements Flyable {
    public function sound() {
        echo "Chirp chirp!";
    }

    public function fly() {
        echo "Flying high!";
    }
}

$bird = new Bird();
$bird->sound(); // Chirp chirp!
$bird->fly();   // Flying high!
$bird->eat();   // Eating food.
```

---

### **7. What are PHP Sessions, and how do they work?**

**Answer:**  
PHP sessions store user information on the server for use across multiple pages. A session ID is stored in a cookie or passed via a URL.

**Example:**

```php
session_start(); // Start a session
$_SESSION['username'] = 'Apurv'; // Set session variable

// On another page
session_start();
echo $_SESSION['username']; // Output: Apurv
```

---

### **8. How do you handle errors in PHP?**

**Answer:**  
PHP offers multiple ways to handle errors:

1. **Using `try-catch` for exceptions**:
   ```php
   try {
       throw new Exception("An error occurred");
   } catch (Exception $e) {
       echo "Caught exception: " . $e->getMessage();
   }
   ```
2. **Using error handlers**:

   ```php
   set_error_handler(function($errno, $errstr) {
       echo "Error [$errno]: $errstr";
   });

   trigger_error("Custom error!", E_USER_WARNING);
   ```

---

### **9. How would you optimize a slow PHP application?**

**Answer:**

- **Caching**: Use tools like Memcached or Redis.
- **Optimize database queries**: Use indexes and avoid N+1 queries.
- **Minify assets**: Compress CSS, JS, and images.
- **Use OpCode caching**: Install tools like OPcache.
- **Profile code**: Use Xdebug or New Relic for bottlenecks.
- **Avoid unnecessary loops** and calculations.

**Example (caching with Memcached):**

```php
$memcached = new Memcached();
$memcached->addServer('localhost', 11211);

$key = 'user_123';
$data = $memcached->get($key);

if (!$data) {
    // Simulate fetching data
    $data = ['name' => 'Apurv', 'role' => 'Developer'];
    $memcached->set($key, $data, 300); // Cache for 5 minutes
}

print_r($data);
```

---

### **10. How do you implement RESTful APIs in PHP?**

**Answer:**  
Use frameworks like Laravel or build APIs manually using routing and JSON responses.

**Example (Simple PHP API):**

```php
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'GET') {
    echo json_encode(['status' => 'success', 'data' => ['name' => 'Apurv']]);
} elseif ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    echo json_encode(['status' => 'created', 'data' => $input]);
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Invalid Method']);
}
```

---
