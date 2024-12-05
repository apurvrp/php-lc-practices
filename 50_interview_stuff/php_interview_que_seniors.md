### PHP interview questions for senior person:

---

Here is an advanced set of PHP interview questions tailored for someone with 9+ years of experience, along with detailed answers and practical examples:

---

### **1. How does PHP handle memory management, and what are circular references?**

**Answer:**  
PHP uses a **reference counting** mechanism for memory management. Variables are destroyed when their reference count reaches zero. However, circular references (when two objects reference each other) can cause memory leaks because the reference count never drops to zero.

**Example:**

```php
class A {
    public $b;
}

class B {
    public $a;
}

$a = new A();
$b = new B();
$a->b = $b;
$b->a = $a;

// Circular reference: Both objects remain in memory until script ends
unset($a, $b); // Does not clear memory unless garbage collection is forced
```

To prevent such leaks, PHP's **garbage collector** (enabled by default) detects and removes circular references.

---

### **2. How would you implement Dependency Injection (DI) in PHP?**

**Answer:**  
Dependency Injection is a design pattern used to decouple object creation and improve testability. You inject dependencies into a class rather than the class creating them.

**Example:**

```php
class Logger {
    public function log($message) {
        echo "Log: $message";
    }
}

class UserService {
    private $logger;

    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }

    public function createUser($name) {
        // Business logic
        $this->logger->log("User $name created.");
    }
}

$logger = new Logger();
$userService = new UserService($logger);
$userService->createUser('Apurv');
```

---

### **3. What are the key differences between PHP 7.x and PHP 8.x?**

**Answer:**

- **JIT Compiler**: PHP 8 introduced the Just-In-Time (JIT) compiler, improving performance for CPU-intensive tasks.
- **Union Types**: Allows multiple data types for a single variable.
- **Attributes**: PHP 8 introduced attributes for metadata.
- **Named Arguments**: Call functions with parameters by name.
- **Error Handling**: Consistent error handling with `Error` and `Exception` classes.

**Example (PHP 8 - Union Types and Named Arguments):**

```php
function calculateArea(int|float $length, int|float $width): int|float {
    return $length * $width;
}

echo calculateArea(length: 5, width: 2.5); // Output: 12.5
```

---

### **4. Explain the purpose of SPL (Standard PHP Library) and provide an example.**

**Answer:**  
SPL is a collection of interfaces and classes for standard tasks such as data structures, file handling, and iterators.

**Example (Using `SplDoublyLinkedList`):**

```php
$list = new SplDoublyLinkedList();
$list->push('A');
$list->push('B');
$list->push('C');

foreach ($list as $value) {
    echo $value . PHP_EOL; // Outputs: A B C
}
```

---

### **5. What are the differences between `Session` and `JWT` for user authentication?**

**Answer:**

- **Session-based Authentication**:

  - Server stores session data.
  - Requires server-side scaling.
  - Good for stateful applications.

- **JWT-based Authentication**:
  - Encodes user data into a token.
  - Stateless; the server does not store session data.
  - Ideal for microservices and stateless APIs.

**Example (Simple JWT Creation with `Firebase\JWT`):**

```php
use Firebase\JWT\JWT;

$key = "your_secret_key";
$payload = [
    "iss" => "yourdomain.com",
    "iat" => time(),
    "exp" => time() + 3600, // 1 hour expiration
    "user_id" => 123
];

$jwt = JWT::encode($payload, $key, 'HS256');
echo $jwt; // Generated token
```

---

### **6. How do you manage large files upload in PHP?**

**Answer:**

- Use PHP settings to configure upload limits:
  ```ini
  ; php.ini
  upload_max_filesize = 50M
  post_max_size = 50M
  max_execution_time = 300
  ```
- Implement chunked uploads to handle large files.

**Example (Basic File Upload):**

```php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['file'];
    if ($file['size'] > 50 * 1024 * 1024) { // Limit: 50MB
        echo "File too large!";
    } else {
        move_uploaded_file($file['tmp_name'], 'uploads/' . $file['name']);
        echo "File uploaded successfully!";
    }
}
```

---

### **7. How would you design a scalable application in PHP?**

**Answer:**

1. **Database Optimization**:
   - Use indexing, sharding, or replication.
2. **Caching**:
   - Implement Memcached or Redis.
3. **Load Balancing**:
   - Use tools like Nginx or AWS ELB.
4. **Decouple services**:
   - Use microservices with REST APIs.
5. **Horizontal Scaling**:
   - Add more servers to handle traffic.

**Example (Caching with Redis):**

```php
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$key = 'user:123';
$data = $redis->get($key);

if (!$data) {
    $data = ['name' => 'Apurv', 'role' => 'Lead Developer'];
    $redis->set($key, json_encode($data), 300); // Cache for 5 minutes
} else {
    $data = json_decode($data, true);
}

print_r($data);
```

---

### **8. How would you implement rate limiting in PHP?**

**Answer:**  
Use a key-value store like Redis to track request counts for IPs or users.

**Example:**

```php
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$ip = $_SERVER['REMOTE_ADDR'];
$key = "rate_limit:$ip";
$limit = 10; // 10 requests
$ttl = 60;  // Time window: 60 seconds

$requests = $redis->incr($key);
if ($requests === 1) {
    $redis->expire($key, $ttl);
}

if ($requests > $limit) {
    http_response_code(429); // Too Many Requests
    echo "Rate limit exceeded. Try again later.";
} else {
    echo "Request allowed.";
}
```

---

### **9. Explain microservices architecture and how PHP fits into it.**

**Answer:**  
Microservices architecture breaks an application into small, loosely coupled services. PHP can fit as a microservice by providing RESTful APIs using frameworks like Laravel or Lumen.

**Example (PHP Microservice with Lumen):**

```php
// routes/web.php
$router->get('/user/{id}', function ($id) {
    return response()->json(['id' => $id, 'name' => 'Apurv']);
});
```

Deploy the service independently and communicate with other services via HTTP or messaging queues like RabbitMQ.

---

### **10. How do you handle concurrent requests in PHP?**

**Answer:**  
PHP can handle concurrency with:

- **Session Locking**: Prevent session write collisions.
- **Asynchronous Execution**: Use tools like ReactPHP or Swoole for async tasks.

**Example (Session Locking):**

```php
session_start();
// Do some operations
session_write_close(); // Release the session lock
```

**Example (ReactPHP):**

```php
require 'vendor/autoload.php';

$loop = React\EventLoop\Factory::create();
$loop->addTimer(2, function () {
    echo "Task completed after 2 seconds.\n";
});
$loop->run();
```

---
