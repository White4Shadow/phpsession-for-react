# phpsession-for-react
#####EXAMPLE send request to server 
  ```javascript 
    requestLogin = () => {
    fetch('sessionManagement.php',{
      method: 'POST',
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        login: true,
        username: USERNAME,
        password: PASSWORD,
      }),
    }).then(response => {
       
       
  });`