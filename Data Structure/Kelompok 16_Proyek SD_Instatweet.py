# anggota kelompok 16:
# Dave Handoko - C14200019
# Nikolaus Filbert Setiawan - C14200030
# Samuel Christopher Suherman - C14200037

#class untuk node history 
class HistoryNode():
    #constructor
    def __init__(self, data):
        self.data = data
        self.next = None
        self.previous = None

#class history -> double linked list, untuk menyimpan halaman-halaman yg pernah dikunjungi 
class History():
    #constructor
    def __init__(self): 
        self.head = None
        self.tail = None
        self.size = 0 #size dari history
        self.currentpointer = None #menunjukkan seekarang ada dipage mana
        self.currentindx = -1 
        self.pressback = False #boolean kalo pernah tekan back

    #tambah data ke paling belakang
    def visit(self, url):
        #cek apa sudah pernah di back atau belum, kalau sudah akan dihapus ketika visit lagi
        if (self.pressback == True):
            pointer = self.tail
            while (pointer.data != self.currentpointer.data):
                self.deletehistory()
                pointer = pointer.previous
                
            self.pressback = False

        #add ke browser history
        nodeBaru = HistoryNode(url)
        if (self.head is None): #tambah pertama kali
            self.head = nodeBaru
            self.tail = nodeBaru
            self.tail.next = self.head
            self.head.previous = self.tail
        else: #tambah belakang 
            pointer = self.head
            for i in range (0, self.size):
                if (i == self.size - 1):
                    simpan = pointer
                pointer = pointer.next

            self.tail = nodeBaru
            simpan.next = nodeBaru
            nodeBaru.previous = simpan
            nodeBaru.next = self.head
            self.head.previous = nodeBaru

        self.currentpointer = self.tail
        self.size += 1
        self.currentindx += 1

    def deletehistory(self): #hapus history yang paling belakang setelah diback lalu tidak diforward/visit lagi
        pointer = self.head
        pointer = self.head
        for i in range (0, self.size):
            if (pointer.next != self.head):
                self.tail = pointer
            pointer = pointer.next

        pointer = None
        self.tail.next = self.head
        self.head.previous = self.tail
        self.size -= 1

    #back ke halaman sebelumnya
    def back(self):
        if (self.currentindx > 0):
            temp = self.currentpointer.previous
            self.currentpointer = temp
            print("Current url: ", self.currentpointer.data)
            self.currentindx -= 1
        else:
            print("No more history!")
            print("Current url: " + self.currentpointer.data)

        self.checkPosition()

    #forward ke halaman selanjutnya
    def forward(self):
        if (self.currentindx < self.size - 1):
            temp = self.currentpointer.next
            self.currentpointer = temp
            print("Current url: ", self.currentpointer.data)
            self.currentindx += 1
        else:
            print("Can't go forward, no forward history")
            print("Current url: ", self.currentpointer.data)

        self.checkPosition()

    def checkPosition(self):
        if (self.currentpointer != self.tail):
            self.pressback = True
        else: 
            self.pressback = False

    #cek sedang berada di page mana sekarang 
    def currentPage(self):
        return self.currentpointer.data
        # print("Current URL: ", self.currentpointer.data)

    def print(self):
        temp = self.head
        for i in range (0, self.size):
            print(temp.data, end=", ")
            temp = temp.next
        print()

#menggunakan hash chain karena akan menampung data yang banyak 
class Friends(): 
    #constructor
    def __init__(self) -> None:
        self.hashtable = [None] * 10 #hashtable
        self.friendsList = [] #list

    #sort dari pertama kali yang difollow
    def printEarliest(self):
        print("Sort by earliest: ")
        for i in range (len(self.friendsList)):
            print(self.friendsList[i])

    #sort dari yang terakhir difollow
    def printLatest(self):
        print("Sort by latest: ")
        latest = self.friendsList[::-1]
        for i in range (len(latest)):
            print(latest[i])
    
    #sort berdasarkan alfabet
    def printByName(self):
        #make a copy of list
        byname = self.friendsList.copy()

        #sort by name
        byname.sort()
        print("Sort by name: ")
        for i in range (len(byname)):
            print(byname[i])

    #hash function menggunakan key mod 10
    def hashFunction(self, id):
        return id % 10

    def follow(self, id, username): #follow dan insert friends ke following 
        index = self.hashFunction(id)
        data = {"id": id, "username": username}

        if (self.hashtable[index] == None):
            self.hashtable[index] = []
            self.hashtable[index].append(data)
        else: 
            self.hashtable[index].append(data)
        
        self.friendsList.append(username)

    def search(self, username):
        found = False
        
        #find username
        for i in range(len(self.hashtable)):
            if (self.hashtable[i] != None):
                for j in range(len(self.hashtable[i])):
                    if (self.hashtable[i][j] != None):
                        if (self.hashtable[i][j]["username"] == username):
                            found = True

        if (not found):
            print("Username not found!")
        else: 
            print("Username found!")

    def unfollow(self, username): #delete friends dari following
        found = False
        index1 = 0
        index2 = 0
        for i in range(len(self.hashtable)):
            if (self.hashtable[i] != None):
                for j in range(len(self.hashtable[i])):
                    if (self.hashtable[i][j] != None):
                        if (self.hashtable[i][j]["username"] == username):
                            found = True
                            index1 = i
                            index2 = j
                            break

        if (found):
            del self.hashtable[index1][index2]
            self.friendsList.remove(username)
            print("Unfollowed!")
        else: 
            print("Username not found!")

#class node queue
class LLNode():
    def __init__(self, data) -> None:
        self.data = data
        self.next = None

#class queue untuk menampung post
class Post():
    #constructor
    def __init__(self): 
        self.head = None
        self.size = 0
    
    def add(self, dataBaru):
        nodeBaru = LLNode(dataBaru)
        if (self.head is None): #tambah pertama kali
            self.head = nodeBaru
            self.next = None
        else:
            pointer = self.head
            while (pointer):
                if (pointer.next is None):
                    simpan = pointer #simpan adalah node paling terakhir sebelum ditambah
                    break
                pointer = pointer.next
            
            simpan.next = nodeBaru
            nodeBaru.next = None
        
        self.size += 1

    def delete(self, index): #delete dilakukan by index
        if (index >= 0 and index < self.size):
            if (index == 0): #hapus di index pertama
                temp = self.head
                self.head = self.head.next
                temp.data = None
                temp.next = None
            elif (self.size - 1 == index): #hapus di index terakhir
                pointer = self.head
                while (pointer):
                    if (pointer.next != None):
                        pointer2 = pointer
                    pointer = pointer.next

                pointer = None
                pointer2.next = None
            else: #hapus di tengah-tengah
                pointer = self.head
                counter = 0
                while (counter != index):
                    if (counter == index - 1):
                        pointer2 = pointer #pointer2 adalah node sebelum data terakhir (pada index paling akhir -1)
                    pointer = pointer.next
                    counter += 1

                pointer2.next = pointer.next
                pointer.next = None
                pointer = None
        else: 
            print("Index out of bounds!")

    def isEmpty(self):
        if (self.size == 0):
            print("You haven't post something yet!")
            print()

    def print(self):
        temp = self.head
        while (temp):
            print(temp.data)
            temp = temp.next

#explore new friends
def explore(back: bool): 
    global idCount

    if (not back):
        history.visit("instatweet.com/explore/")

    pilih = 0
    loop = True
    while (loop):
        print("1. Search")
        print("2. Back")
        print("3. Forward")
        print("4. Menu")
        print("5. Home")
        print("6. Profile")
        pilih = int(input("Choose: "))

        if (pilih == 1):
            #search username
            search = input("Search new friends: ")
            ask = input("Follow? (Y/N): ")
            print()
            
            if (ask == 'y' or ask == 'Y'):
                friends.follow(idCount, search)
                idCount += 1
        elif (pilih == 2 or pilih == 3):
            loop = False
        elif (pilih == 4):
            loop = False
            menu(False)
        elif (pilih == 5):
            loop = False
            home(False)
        elif (pilih == 6):
            loop = False
            profile(False)
        else: 
            print("Silahkan pilih menu yang tersedia!")

    if (pilih == 2):
        history.back()
        condition()
    elif (pilih == 3):
        history.forward()
        condition()

#see following
def following(back: bool):
    if (not back):
        history.visit("instatweet.com/profile/following/")

    print("Total following: ", len(friends.friendsList))
    if (len(friends.friendsList) == 0):
        print("Please follow someone!")
    else: 
        friends.printLatest() #print by default
    print()

    pilih = 0
    loop = True
    while (loop):
        print("1. Sort by latest")
        print("2. Sort by earliest")
        print("3. Sort by name")
        print("4. Back")
        print("5. Forward")
        print("6. Menu")
        print("7. Home")
        print("8. Explore")
        print("9. Profile")
        pilih = int(input("Choose: "))
        print()

        if (pilih == 1):
            friends.printLatest()
        elif (pilih == 2):
            friends.printEarliest()
        elif (pilih == 3):
            friends.printByName()
        elif (pilih == 4 or pilih == 5):
            loop = False
        elif (pilih == 6):
            loop = False
            menu(False)
        elif (pilih == 7):
            loop = False
            home(False)
        elif (pilih == 8):
            loop = False
            explore(False)
        elif (pilih == 9):
            loop = False
            profile(False)
        else: 
            print("Silahkan pilih menu yang tersedia!")

    if (pilih == 4):
        history.back()
        condition()
    elif (pilih == 5):
        history.forward()
        condition()

#edit profile
def edit(back: bool):
    if (not back):
        history.visit("instatweet.com/profile/edit/")

    pilih = 0
    loop = True
    while (loop):
        #display profile
        print("Name: ", profileData["name"])
        print("Username: ", profileData["username"])
        print("Bio: ", profileData["bio"])
        print("Email: ", profileData["email"])

        print()
        print("1. Name")
        print("2. Username")
        print("3. Bio")
        print("4. Email")
        print("5. Back")
        print("6. Forward")
        print("7. Menu")
        print("8. Home")
        print("9. Explore")
        print("10. Profile")
        pilih = int(input("Choose: "))
        print()

        if (pilih == 1):
            name = input("Change name: ")
            ask = input("Save? (Y/N): ")
            print()

            if (ask == 'y' or ask == 'Y'):
                profileData["name"] = name
        elif (pilih == 2):
            username = input("Change username: ")
            ask = input("Save? (Y/N): ")
            print()

            if (ask == 'y' or ask == 'Y'):
                profileData["username"] = username
        elif (pilih == 3):
            bio = input("Change bio: ")
            ask = input("Save? (Y/N): ")
            print()

            if (ask == 'y' or ask == 'Y'):
                profileData["bio"] = bio
        elif (pilih == 4):
            email = input("Change email: ")
            ask = input("Save? (Y/N): ")
            print()

            if (ask == 'y' or ask == 'Y'):
                profileData["email"] = email
        elif (pilih == 5 or pilih == 6):
            loop = False
        elif (pilih == 7):
            loop = False
            menu(False)
        elif (pilih == 8):
            loop = False
            home(False)
        elif (pilih == 9):
            loop = False
            explore(False)
        elif (pilih == 10):
            loop = False
            profile(False)
        else:
            print("Silahkan pilih menu yang tersedia!")
    
    if (pilih == 5):
        history.back()
        condition()
    elif (pilih == 6):
        history.forward()
        condition()

#profile user
def profile(back: bool):
    if (not back):
        history.visit("instatweet.com/profile/")

    pilih = 0
    loop = True
    while (loop):
        print("Your post: ")
        if (not profileData["post"].isEmpty()):
            profileData["post"].print()

        print("1. Edit profile")
        print("2. Following")
        print("3. Delete Post")
        print("4. Back")
        print("5. Forward")
        print("6. Menu")
        print("7. Home")
        print("8. Explore")
        pilih = int(input("Choose: "))
        print()

        if (pilih == 1):
            loop = False
            edit(False)
        elif (pilih == 2):
            loop = False
            following(False)
        elif (pilih == 3):
            choose = int(input("Choose post: "))
            mypost.delete(choose)
        elif (pilih == 4 or pilih == 5):
            loop = False
        elif (pilih == 6):
            loop = False
            menu(False)
        elif (pilih == 7):
            loop = False
            home(False)
        elif (pilih == 8):
            loop = False
            explore(False)
        else: 
            print("Silahkan pilih menu yang tersedia!")
    
    if (pilih == 4):
        history.back()
        condition()
    elif (pilih == 5):
        history.forward()
        condition()

#home
def home(back: bool):
    if (not back):
        history.visit("instatweet.com/home/")

    loop = True
    pilih = 0
    while (loop):
        print("1. Post")
        print("2. Back")
        print("3. Forward")
        print("4. Menu")
        print("5. Explore")
        print("6. Profile")
        pilih = int(input("Choose: "))
        print()

        if (pilih == 1):
            post = input("Write something: ")
            ask = input("Post? (Y/N): ")

            if (ask == 'y' or ask =='Y'):
                mypost.add(post)
        elif (pilih == 2 or pilih == 3):
            loop = False
        elif (pilih == 4):
            loop = False
            menu(False)
        elif (pilih == 5):
            loop = False
            explore(False)
        elif (pilih == 6):
            loop = False
            profile(False)
        else: 
            print("Silahkan pilih menu yang tersedia!")

    if (pilih == 2):
        history.back()
        condition()
    elif (pilih == 3):
        history.forward()
        condition()
    
#menu
def menu(back: bool):
    if (not back):
        history.visit("instatweet.com/menu/")

    loop = True
    while (loop):
        print("1. Home")
        print("2. Explore")
        print("3. Profile")
        print("4. Back") 
        print("5. Forward")
        print("6. Exit app")
        pilih = int(input("Choose: "))
        print()

        if (pilih == 1):
            loop = False
            home(False)
        elif (pilih == 2): 
            loop = False
            explore(False)
        elif (pilih == 3):
            loop = False
            profile(False)
        elif (pilih == 4):
            history.back()
            condition()
        elif (pilih == 5):
            history.forward()
            condition()
        elif (pilih == 6):
            loop = False
        else:
            print("Silahkan pilih menu yang tersedia!")

#backward or forward condition
def condition():
    if ("home" in history.currentPage()):
        home(True)
    elif ("explore" in history.currentPage()):
        explore(True)
    elif ("following" in history.currentPage()):
        following(True)
    elif ("edit" in history.currentPage()):
        edit(True)
    elif ("profile" in history.currentPage()):
        profile(True)
    elif ("menu" in history.currentPage()):
        menu(True)

#main
history = History()
friends = Friends()
mypost = Post()
idCount = 1
profileData = {
    "name": "Samuel Christopher",
    "username": "samuel.christopherrrr",
    "bio": "Hello, my name is Samuel. Nice to meet you!",
    "email": "samchris@gmail.com",
    "post": mypost
}

menu(False)