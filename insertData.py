from random import randint

# names = ['James', 'John', 'Robert', 'Michael', 'William', 'David', 'Richard', 'Joseph', 'Thomas', 'Charles', 'Chris', 'Daniel', 'Matt', 'Anthony', 'Donald', 'Mark', 'Paul', 'Steven', 'Andrew', 'Kenneth', 'Joshua', 'George', 'Kevin', 'Brian', 'Edward', 'Ronald', 'Gary', 'Ash', 'Brock', 'Jason', 'Grant', 'Ryan', 'Eric', 'Laryy', 'Frank', 'Phineas', 'Ferb', 'Benjamin', 'Gregory', 'Sherlock', 'Sophie', 'Tailor', 'Aaron', 'Paul', 'Vaas', 'Lisa', 'Citra']
# names = ['Kyle', 'Kolin', 'Casey', 'Panda', 'Daisy', 'Mini', 'Shindeyuro', 'Lee', 'Shin', 'Elon', 'Rishabh', 'Raghav', 'Khushboo', 'Riya', 'Vaibhav', 'Kaustabh', 'Somil', 'Deedee', 'Oggy', 'Jill', 'Hoyt', 'Harsh', 'Priya', 'Shreya', 'Pappubhai', 'Munna', 'Pankaj']
names = ['Hoja', 'Bheem', 'Chutki', 'Kalia', 'Dholu', 'Bholu', 'Jaggu', 'Shweta', 'Prabhjot', 'Jaspreet', 'Anuj', 'Ishaan', 'Agni', 'Rishi', 'Navonil', 'Shivam', 'Sparsh', 'Aviral', 'Markshiba', 'Soumyo', 'Soumya', 'Vardhan', 'Patnaik', 'Adi', 'Keshav', 'Krishh', 'Vivek', 'Rakshas', 'Raksha', 'Divyam', 'Bhopali', 'Gopali', 'Gopal', 'Sameer', 'Jayaha', 'Corvo', 'Antonio', 'Emilya', 'Sokolov', 'Irodov', 'Krotov', 'HarishChandra', 'Amitabh', 'Saurabhh', 'Gnaneshwar', 'Divyansh', 'Atharva', 'Mani', 'Naman', 'Pauaa', 'Pratyush', 'Ujwal', 'Prajjwal', 'Modit', 'Modi', 'Mudita', 'Vanshaj', 'Bahubali']


with open('sqlFile.txt', 'w') as sqlFile:
    for i in range(len(names)):
        username, easy, medium, hard, extreme = names[i], randint(6, 30)*5, 0, 0, 0
        if easy >= 50:
            medium = randint(6, 40)*5
            if medium >= 100:
                hard = randint(6, 50)*5
                if hard >= 150:
                    extreme = randint(6, 54)*5

        score = easy + medium + hard + extreme

        raw_statement = f"INSERT INTO `users` (`username`, `userpassword`, `progress`, `Score`, `MaxScoreEasy`, `MaxScoreMedium`, `MaxScoreHard`, `MaxScoreExtreme`) VALUES ('{username}', '123', '0', '{score}', '{easy}', '{medium}', '{hard}', '{extreme}');\n"
        sqlFile.write(raw_statement)

