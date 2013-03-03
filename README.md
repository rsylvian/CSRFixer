What is a CSRF attack ?
-----------------------

Cross-site request forgery, also known as a one-click attack or session riding is a type of malicious exploit of a website whereby unauthorized commands are transmitted from a user that the website trusts. CSRF exploits the trust that a site has in a user's browser.

Example
-------

Alice wishes to stole $10 000 from Bob using bank.com :

- Alice gets to know the link to make a money transfer.
- e.g : `http://bank.com/action.do?user=Bob&receiver=Alice&amount=10000`
- Alice must trick Bob into submitting the request. The most basic method is to send Bob an HTML email containing the following :

```html
<p>
Hello Bob !
View my Pictures :
<img src="http://bank.com/action.do?user=Bob&receiver=Alice&amount=10000" width="1" height="1" border="0">
</p>
```

If this image tag were included in the email, Bob would only see a little box indicating that the browser could not render the image. However, the browser will still submit the request to bank.com without any visual indication that the transfer has taken place.  
(source : [Owasp.org][1])

Protect your Webapp with CSRFixer
=================================

CSRFixer provides easy-to-use protection against Cross Site Request Forgerie vulnerabilities (CSRF).  
With only one file in the client side and one directory in the server side your application is safe !

Installation
------------

- Upload in your server the directory `CSRFixer` (located in `server_side` in this repository).
- Install and configure CSRFixer in your client side application.  

How to use CSRFixer ?
---------------------


  [1]: https://www.owasp.org/index.php/Cross-Site_Request_Forgery_(CSRF)