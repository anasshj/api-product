### README.md

# Product API

## Overview
This project is a Symfony-based API for managing products. It supports CRUD operations and is designed to be tested with Postman and shared on GitHub.

---

## API Endpoints
### 1. **GET** `/api/products`
- Retrieves all products.

### 2. **POST** `/api/products`
- Adds a new product.
- Example Body (JSON):
  ```json
  {
    "name": "Product A",
    "price": 10.0
  }
  ```

### 3. **PUT** `/api/products/{id}`
- Updates an existing product.
- Example Body (JSON):
  ```json
  {
    "name": "Updated Product A",
    "price": 15.5
  }
  ```

### 4. **DELETE** `/api/products/{id}`
- Deletes a product.

---

## Testing with Postman
1. **Set up Postman**:
   - Create a collection named `Product API`.
   - Add requests for all endpoints.
2. **Execute Requests**:
   - Validate responses for each endpoint (e.g., GET returns products, POST adds a product, etc.).
3. **Generate a Report**:
   - Run the collection using the Collection Runner.
   - Export results as JSON or HTML.

---

## Publish Project on GitHub
1. **Initialize Git**:
   ```bash
   git init
   git add .
   git commit -m "Initial commit"
   ```

2. **Create Repository**:
   - On GitHub, create a new repository (e.g., `product-api`).
   - Copy the repository URL.

3. **Push Code**:
   ```bash
   git remote add origin https://github.com/anasshj/api-product.git
   git branch -M main
   git push -u origin main
   ```

---

## Collaboration
- Share the GitHub repository URL with collaborators.
- Ensure the repository includes this `README.md` for guidance.

--- 

🎉 **Done!** Your Product API is ready to use and collaborate on!