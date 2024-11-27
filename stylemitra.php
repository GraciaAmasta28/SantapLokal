* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  background-color: #f5e1c0;
}

.container {
  width: 100%;
  max-width: 800px;
  margin: 0 auto;
}

header {
  text-align: center;
  padding: 20px;
}

.logo {
  width: 150px;
  height: auto;
}

.form-section {
  background-color: #aab396;
  padding: 30px;
  border-radius: 10px;
  margin-top: 20px;
}

.form-section h2 {
  color: white;
  font-size: 24px;
  margin-bottom: 20px;
}

form {
  display: flex;
  flex-direction: column;
}

label {
  color: #7c2f1b;
  font-size: 16px;
  margin-bottom: 10px;
}

input[type="text"],
textarea {
  background-color: #f5e1c0;
  border: 2px solid #7c2f1b;
  border-radius: 5px;
  padding: 10px;
  font-size: 14px;
  margin-bottom: 20px;
  width: 100%;
}

input[type="number"] {
  background-color: #f5e1c0;
  border: 2px solid #7c2f1b;
  border-radius: 5px;
  padding: 10px;
  font-size: 14px;
  margin-bottom: 20px;
  width: 100%;
}

input[type="submit"] {
  background-color: #7c2f1b;
  color: white;
  border: none;
  padding: 10px 20px;
  font-size: 16px;
  border-radius: 5px;
  margin-top: 50px;
}

input[type="submit"]:hover {
  background-color: #5a2114;
}

textarea {
  height: 100px;
  resize: none;
}

button {
  background-color: #7c2f1b;
  color: white;
  border: none;
  padding: 10px 20px;
  font-size: 16px;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 10px;
}

button:hover {
  background-color: #5a2114;
}

.kembali {
  background-color: #aab396;
  color: white;
  border: none;
  padding: 10px 20px;
  font-size: 16px;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 50px;
  text-align: center;
  text-decoration: none;
}

.kembali:hover {
  background-color: #7c2f1b;
}

.footer-logo {
  width: 150px;
}
