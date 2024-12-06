### **What is a Stateless Server?**

A **stateless server** is a server that does not keep track of client information or application state between requests. Each request from a client is treated as a completely independent interaction, with no memory of previous requests.

Since the server does not store any session or user data, the client is responsible for providing all necessary information with every request.

---

### **What is a Stateless API?**

A **stateless API** is an API where each request from the client contains all the information needed for the server to process it. The server does not rely on stored data from previous requests to handle a new one.

Stateless APIs are commonly implemented using **REST (Representational State Transfer)**, where each interaction is self-contained.

---

### **Benefits of Stateless Servers and APIs:**

1. **Scalability**: Stateless design allows servers to scale easily because no session data needs to be shared between servers.
2. **Simpler Design**: Since no state is stored, the server implementation is simpler.
3. **Reliability**: Servers can crash or restart without losing any session data since they store nothing.

---

### **Practical Example of a Stateless Server and API**

#### **Scenario: Weather Information API**

1. **Request**: The client sends a request with all the required data (e.g., city name).
2. **Response**: The server processes the request and returns the weather information without storing any session data.

#### **Example: Stateless API Implementation**

```php
<?php
// Example: A simple stateless API to fetch weather information
header('Content-Type: application/json');

// Mock data for demonstration
$weatherData = [
    "New York" => ["temperature" => "15°C", "condition" => "Cloudy"],
    "London" => ["temperature" => "10°C", "condition" => "Rainy"],
    "Tokyo" => ["temperature" => "20°C", "condition" => "Sunny"],
];

// Get city name from query parameters
$city = $_GET['city'] ?? null;

if ($city && array_key_exists($city, $weatherData)) {
    // Return the weather information for the requested city
    echo json_encode([
        "city" => $city,
        "weather" => $weatherData[$city]
    ]);
} else {
    // Return an error response for unknown cities
    echo json_encode([
        "error" => "City not found or no city specified."
    ]);
}
?>
```

#### **Client Request Example:**

```plaintext
GET /weather.php?city=New+York
```

#### **Server Response Example:**

```json
{
  "city": "New York",
  "weather": {
    "temperature": "15°C",
    "condition": "Cloudy"
  }
}
```

---

### **How is it Stateless?**

1. **Independent Requests**: The server does not remember the client or store session data. The client must provide the `city` parameter with every request.
2. **Self-contained Interaction**: Each request contains all the information required for processing (the `city` parameter).
3. **No Memory of Previous Requests**: The server processes the current request without referring to past interactions.

---

### **Comparison with Stateful APIs**

- In a **stateful API**, the server remembers details about the client (e.g., user authentication, session data).
- Example: A shopping cart stored on the server, where the server remembers the cart's content for the user.

#### **Stateful Example:**

- A user logs in and adds items to their cart. The server keeps the cart's state in memory.

#### **Stateless Example:**

- The client sends all cart details (e.g., item IDs, quantities) with every request.

---

### **Key Takeaways:**

- A **stateless server** does not store session or user data between requests.
- A **stateless API** requires the client to provide all necessary data with every request.
- Stateless design simplifies scalability and reliability, making it ideal for APIs like REST.
