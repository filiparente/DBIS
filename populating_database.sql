insert into person (VAT,name,address_street,address_city,address_zip)
values
    (101,"Meredith Grey","North Middle River Lane","Laurel","2000-001"),
    (102,"Cristina Yang","SW. Pennington Drive","Altoona","2000-002"),
    (103,"Izzie Stevens","Myrtle St.","Hopewell","2000-003"),
    (104,"Alex Karev","Military Drive","Rolling Meadows","2000-004"),
    (105,"George Malley","S. Amerige Street","Durham","2000-005"),
    (106,"Miranda Bailey","Richardson Street","Dover","2001-006"),
    (107,"Richard Webber","Myrtle Street","Melbourne","2000-007"),
    (108,"Preston Burke","Jockey Hollow Court", "Palm City","2000-008"),
    (109,"Derek Shepherd","E. Tunnel Ave.","Christiansburg","2000-009"),
    (110,"Addison Montgomery","Eagle Drive","Fairfax","2000-010"),
    (111,"Callie Torres","West Pleasant Drive","Elkridge","2000-011"),
    (112,"Mark Sloan","Pilgrim St.","Bristol","2000-012"),
    (113,"Lexie Grey","Gonzales Dr.","Newton","2000-013"),
    (114,"Erica Hahn","Strawberry Ave.","Chevy Chase","2000-014"),
    (115,"Owen Hunt", "W. Longfellow Road","Beachwood","2000-015"),
    (116,"Arizona Robbins","Brewery Street","West Springfield","2000-016"),
    (117,"Teddy Altman","Bridle St.","Johnston","2000-017"),
    (118,"April Kepner","Vernon Street","North Kingstown","2000-018"),
    (119,"Jackson Avery","Inverness Road","Irvington","2000-019"),
    (120,"Jo Karev","Academy Drive","Bloomington","2000-020"),
    (121,"Shane Ross","Rockville St.","SW. Peachtree Road","2000-021"),
    (122,"Stephanie Edwards","SW. Peachtree Road","Trenton","2000-022"),
    (123,"Leah Murphy","Kingston Drive","Brockton","2000-023"),
    (124,"Amelia Shepherd","Heather Road","Wilmette","2000-024"),
    (125,"Maggie Pierce","Leatherwood Road","Peabody","2000-025"),
    (126,"Benjamin Warren","Amerige Street","Newport News","2000-026"),
    (127,"Andrew DeLuca","Academy Lane","Hickory","2000-027"),
    (128,"Nathan Riggs","Edgefield Lane","Rahway","2000-028"),
    (129, "John Smith", "Koxford Street", "Mumford", "2000-029"),
    (130, "Dexter", "Blood Street", "Murder city", "2000-030");

insert into phone_number (VAT,phone)
values
    (101,900000101),
    (102,900000102),
    (103,900000103),
    (104,900000104),
    (105,900000105),
    (106,900000106),
    (107,900000107),
    (108,900000108),
    (109,900000109),
    (110,900000110),
    (111,900000111),
    (112,900000112),
    (113,900000113),
    (114,900000114),
    (115,900000115),
    (116,900000116),
    (117,900000117),
    (118,900000118),
    (119,900000119),
    (120,900000120),
    (121,900000121),
    (122,900000122),
    (123,900000123),
    (124,900000124),
    (125,900000125),
    (126,900000126),
    (127,900000127),
    (128,900000128),
    (129, 900000129),
    (130, 900000130);

insert into client (VAT)
values
    (101),
    (102),
    (103),
    (104),
    (105),
    (106),
    (107),
    (108),
    (109),
    (110),
    (111),
    (112),
    (113),
    (114),
    (115),
    (116),
    (117),
    (118),
    (119),
    (120),
    (129),
    (130);

insert into veterinary (VAT,specialization,bio)
values
    (121,"Anaesthesiologist","9 years of experience, University of Calgary"),
    (122,"Clinical pathologist","12 years of experience, Royal College"),
    (123,"Birds","5 years of experience, Royal College"),
    (124,"Animal welfare","15 years of experience, University of Guelph"),
    (129, "Animal nutrition", "7 years of experience");

insert into assistant (VAT)
values
    (125),
    (126),
    (127),
    (128),
    (130);

insert into species (name, description)
Values
    ("bulldog","breed of dog"),
    ("poodle","breed of dog"),
    ("chihuahua","breed of dog"),
    ("rottweiler","breed of dog"),
    ("beagle","breed of dog"),
    ("boxer","breed of dog"),
    ("weimaraner","breed of dog"),
    ("dog","dog"),
    ("siamese","breed of cat"),
    ("persian","breed of cat"),
    ("maine coon","breed of cat"),
    ("ragdoll","breed of cat"),
    ("bengal","breed of cat"),
    ("abyssinian","breed of cat"),
    ("birman","breed of cat"),
    ("duroc","breed of pig"),
    ("berkshire","breed of pig"),
    ("yorkshire","breed of pig"),
    ("red-eared slider turtle","breed of turtle"),
    ("eastern box turtle","breed of turtle"),
    ("western painted turtle","breed of turtle"),
    ("map turtle","breed of turtle"),
    ("wood turtle","breed of turtle"),
    ("Canis","dog's Genus"),
    ("Canidae","dog's Family"),
    ("Carnivora","dog's Order"),
    ("Mammalia","dog's Class"),
    ("bird","bird"),
    ("Aves","bird's Class"),
    ("Ornithurae","bird's Clade"),
    ("cat", "cat"),
    ("Felis silvestris", "cat's Species"),
    ("Felis", "cat's Genus"),
    ("Felidae", "cat's Family"),
    ("pig", "pig"),
    ("Sus", "pig's Genus"),
    ("Suidae", "pig's Family"),
    ("Artiodactyla", "pig's Order"),
    ("turtle","turtle"),
    ("Testudines","turtle's Order"),
    ("Reptilia","turtle's Class");

insert into generalization_species (name1, name2)
values
    ("rottweiler","dog"),
    ("poodle","dog"),
    ("chihuahua","dog"),
    ("bulldog","dog"),
    ("beagle","dog"),
    ("boxer","dog"),
    ("weimaraner","dog"),
    ("siamese","cat"),
    ("persian","cat"),
    ("maine coon","cat"),
    ("ragdoll","cat"),
    ("bengal","cat"),
    ("abyssinian","cat"),
    ("birman","cat"),
    ("duroc","pig"),
    ("berkshire","pig"),
    ("yorkshire","pig"),
    ("red-eared slider turtle","turtle"),
    ("eastern box turtle","turtle"),
    ("western painted turtle","turtle"),
    ("map turtle","turtle"),
    ("wood turtle","turtle"),
    ("dog","Canis"),
    ("Canis","Canidae"),
    ("Canidae","Carnivora"),
    ("Carnivora","Mammalia"),
    ("bird","Aves"),
    ("Aves","Ornithurae"),
    ("cat","Felis silvestris"),
    ("Felis silvestris","Felis"),
    ("Felis","Felidae"),
    ("Felidae","Carnivora"),
    ("pig","Sus"),
    ("Sus","Suidae"),
    ("Suidae","Artiodactyla"),
    ("Artiodactyla","Mammalia"),
    ("turtle","Testudines"),
    ("Testudines","Reptilia");

insert into animal (name,VAT,species_name,colour,gender,birth_year,age)
values
    ("Bella",101,"boxer","black","female",2005,13),
    ("Lucy",102,"weimaraner","white","female",2010,8),
    ("Ash",103,"beagle","brown","male",2011,7),
    ("Benji",104,"poodle","black","male",2010,8),
    ("Twit",105,"bird","yellow","female",2012,4),
    ("Kika", 101, "bulldog", "brown", "female", 2015, 3),
    ("Leo", 117, "persian", "yellow", "male", 2014, 4),
    ("Deutsch", 109, "bird", "grey", "male", 2002, 16),
    ("Eva", 104, "red-eared slider turtle", "brown", "female", 2013, 5),
    ("Vitória", 129,"bird","brown","female",2013,5),
    ("Willy", 101, "chihuahua","brown", "male",2008,10),
    ("Bochita", 129, "chihuahua","grey", "male",2010,8),
    ("Kashey", 129, "chihuahua","black", "female",2011,7),
    ("Brownie", 114, "rottweiler","grey", "male",2015,3),
    ("Caju", 130, "beagle","white", "male",2012,6),
    ("Caju", 120, "boxer","brown", "male",2016,2),
    ("Cloud", 106, "siamese", "white", "female", 2012, 6),
    ("Star", 106, "birman", "black", "male", 2014, 4);

insert into consult (name,VAT_owner,date_timestamp,s,o,a,p,VAT_client,VAT_vet,weight)
values
    ("Bella",101,"2018-02-17 13:12:20","s","o","a","p",101,121,30),
    ("Lucy", 102, "2018-02-20 09:20:18", "s", "Animal presents symptoms of obesity and high cholesterol.", "a", "p", 103, 122, 40.00),
    ("Twit",105,"2018-03-02 10:14:19","s","o","a","p",110,123,4),
    ("Kika", 101, "2017-03-02 10:14:19", "s", "may be obese.", "a", "p", 101, 129, 33.20),
    ("Leo", 117, "2017-04-12 14:47:10", "s", "o", "a", "p", 117, 129, 20.50),
    ("Eva", 104, "2017-07-15 11:30:54", "s", "o", "a", "p", 104, 129, 30.70),
    ("Deutsch", 109, "2018-05-04 16:12:04", "s", "o", "a", "p", 109, 129, 3.42),
    ("Vitória", 129,"2018-08-07 13:20:04", "s", "may have broken a wing.", "a", "p", 129, 123, 8.80),
    ("Willy", 101, "2017-03-02 13:45:57", "s", "o", "a", "p", 101, 129, 25.20),
    ("Willy", 101, "2017-03-04 10:20:06", "s", "o", "a", "p", 101, 129, 25.15),
    ("Bochita", 129, "2017-02-17 10:10:21", "s", "o", "a", "p", 101, 129, 20.65),
    ("Kashey", 129, "2017-02-17 15:10:21", "s", "o", "a", "p", 101, 129, 15.37),
    ("Ash", 103, "2018-04-12 14:34:32", "s", "o", "a", "p", 102, 124, 24.50),
    ("Ash", 103, "2018-06-18 16:05:12", "s", "o", "a", "p", 103, 121, 26.10),
    ("Benji", 104, "2017-09-16 14:01:45", "s", "o", "a", "p", 104, 122, 18.20),
    ("Brownie", 114, "2017-12-27 12:20:33", "s", "o", "a", "p", 114, 123, 28.10),
    ("Brownie", 114, "2018-01-17 13:35:20", "s", "o", "a", "p", 114, 123, 25.40),
    ("Caju", 130, "2018-02-23 17:15:20", "s", "o", "a", "p", 130, 124, 15.84),
    ("Caju", 130, "2018-05-23 15:15:20", "s", "o", "a", "p", 130, 129, 16.24),
    ("Caju", 120, "2018-06-13 16:49:11", "s", "o", "a", "p", 120, 122, 30.11),
    ("Cloud", 106, "2018-07-11 12:12:49", "s", "o", "a", "p", 106, 121, 5.20),
    ("Star", 106, "2017-07-05 10:01:53", "s", "o", "a", "p", 106, 122, 6.04),
    ("Star", 106, "2018-07-05 11:10:43", "s", "o", "a", "p", 106, 123, 7.13);




insert into participation (name,VAT_owner,date_timestamp,VAT_assistant)
values
    ("Bella",101,"2018-02-17 13:12:20",128),
    ("Twit",105,"2018-03-02 10:14:19",127),
    ("Leo", 117, "2017-04-12 14:47:10",125),
    ("Leo", 117, "2017-04-12 14:47:10",126),
    ("Leo", 117, "2017-04-12 14:47:10",127),
    ("Leo", 117, "2017-04-12 14:47:10",128),
    ("Eva", 104, "2017-07-15 11:30:54",125),
    ("Eva", 104, "2017-07-15 11:30:54",126),
    ("Kika",101,"2017-03-02 10:14:19",125),
    ("Kika",101,"2017-03-02 10:14:19",126),
    ("Vitória", 129,"2018-08-07 13:20:04", 125),
    ("Deutsch", 109, "2018-05-04 16:12:04",130),
    ("Bochita", 129, "2017-02-17 10:10:21",126),
    ("Bochita", 129, "2017-02-17 10:10:21",128),
    ("Ash", 103, "2018-04-12 14:34:32", 127),
    ("Ash", 103, "2018-06-18 16:05:12",125),
    ("Caju", 130, "2018-02-23 17:15:20",128),
    ("Caju", 120, "2018-06-13 16:49:11", 130),
    ("Cloud", 106, "2018-07-11 12:12:49",125),
    ("Cloud", 106, "2018-07-11 12:12:49",128);






insert into diagnosis_code(code, name)
values
    (1, "Fever, slow metabolism"),
    (2, "Sinusitis"),
    (3, "Infection"),
    (4, "Kidney failure"),
    (5, "Blindness"),
    (6, "Parvo"),
    (7, "Lyme disease"),
    (8, "Poisoning"),
    (9, "Heartworm disease"),
    (10, "Cancer"),
    (11, "Leishmaniose"),
    (12, "Gastric Torsion"),
    (13, "Diabetes"),
    (14, "Immunodeficiency Virus"),
    (15, "Leukemia"),
    (16, "Rabies"),
    (17, "Obesity");




insert into consult_diagnosis(code, name, VAT_owner, date_timestamp)
Values
    (17, "Lucy", 102, "2018-02-20 09:20:18"),
    (12,"Deutsch", 109,"2018-05-04 16:12:04"),
    (13,"Eva", 104, "2017-07-15 11:30:54"),
    (2,"Eva", 104, "2017-07-15 11:30:54"),
    (3,"Eva", 104, "2017-07-15 11:30:54"),
    (14,"Leo", 117, "2017-04-12 14:47:10"),
    (2,"Leo", 117, "2017-04-12 14:47:10"),
    (2,"Kika", 101, "2017-03-02 10:14:19"),
    (15,"Vitória", 129,"2018-08-07 13:20:04"),
    (4,"Deutsch", 109,"2018-05-04 16:12:04"),
    (3,"Willy", 101, "2017-03-02 13:45:57"),
    (1,"Willy", 101, "2017-03-02 13:45:57"),
    (1,"Willy", 101, "2017-03-04 10:20:06"),
    (3,"Bochita", 129, "2017-02-17 10:10:21"),
    (3,"Kashey", 129, "2017-02-17 15:10:21"),
    (6,"Ash", 103, "2018-04-12 14:34:32"),
    (16,"Ash", 103, "2018-06-18 16:05:12"),
    (14, "Benji", 104, "2017-09-16 14:01:45"),
    (5, "Brownie", 114, "2017-12-27 12:20:33"),
    (7, "Brownie", 114, "2018-01-17 13:35:20"),
    (6,"Caju", 130, "2018-02-23 17:15:20"),
    (8,"Caju", 130, "2018-05-23 15:15:20"),
    (4, "Caju", 120, "2018-06-13 16:49:11"),
    (10, "Cloud", 106, "2018-07-11 12:12:49"),
    (9,"Star", 106, "2017-07-05 10:01:53"),
    (11,"Star", 106, "2018-07-05 11:10:43");


insert into medication (name, lab, dosage)
values
    ("Doxilax", "Montfield Lab", "400mg"),
    ("Papilem", "Montfield Lab", "200mg"),
    ("Loxifell", "Manhattan Lab&Co", "100mg"),
    ("Catnuciti", "Manhattan Lab&Co", "100ml"),
    ("Catxim", "Manhattan Lab&Co", "50ml");
 

insert into procedures (name,VAT_owner,date_timestamp,num,description)
values
    ("Bella",101,"2018-02-17 13:12:20",1,"radiography to torax"),
    ("Lucy",102,"2018-02-20 09:20:18",1,"radiography to right leg"),
    ("Kika", 101, "2017-03-02 10:14:19",1,"blood test"),
    ("Lucy",102,"2018-02-20 09:20:18",2,"blood test"),
    ("Vitória",129,"2018-08-07 13:20:04",1,"radiography to wing"),
    ("Deutsch", 109, "2018-05-04 16:12:04",1,"blood test"),
    ("Kika", 101,"2017-03-02 10:14:19", 2, "radiography to torax"),
    ("Leo", 117, "2017-04-12 14:47:10", 1, "blood test"),
    ("Willy", 101, "2017-03-02 13:45:57",1,"biopsy test"),
    ("Willy", 101, "2017-03-02 13:45:57",2,"endoscopy"),
    ("Willy", 101, "2017-03-02 13:45:57",3,"urine test"),
    ("Kashey", 129, "2017-02-17 15:10:21",1,"blood test"),
    ("Kashey", 129, "2017-02-17 15:10:21",2,"urine test"),
    ("Ash", 103, "2018-04-12 14:34:32",1,"biopsy test"),
    ("Caju", 130, "2018-02-23 17:15:20",1,"right leg radiography"),
    ("Caju", 130, "2018-02-23 17:15:20",2,"ultrasonography"),
    ("Caju", 130, "2018-02-23 17:15:20",3,"stool test"),
    ("Benji", 104, "2017-09-16 14:01:45",1,"blood test"),
    ("Benji", 104, "2017-09-16 14:01:45",2,"urine test"),
    ("Star", 106, "2017-07-05 10:01:53",1,"blood test"),
    ("Star", 106, "2017-07-05 10:01:53",2,"urine test"),
    ("Cloud", 106, "2018-07-11 12:12:49",1,"blood test"),
    ("Cloud", 106, "2018-07-11 12:12:49",2,"urine test");

insert into performed (name,VAT_owner,date_timestamp,num,VAT_assistant)
values
    ("Bella",101,"2018-02-17 13:12:20",1,128),
    ("Lucy",102,"2018-02-20 09:20:18",1,127),
    ("Vitória", 129,"2018-08-07 13:20:04",1,127),
    ("Kika", 101,"2017-03-02 10:14:19", 2, 125),
    ("Willy", 101, "2017-03-02 13:45:57",1,125),
    ("Willy", 101, "2017-03-02 13:45:57",2,126),
    ("Willy", 101, "2017-03-02 13:45:57",3,127),
    ("Kashey", 129, "2017-02-17 15:10:21",1,128),
    ("Kashey", 129, "2017-02-17 15:10:21",2,130),
    ("Ash", 103, "2018-04-12 14:34:32",1,125),
    ("Caju", 130, "2018-02-23 17:15:20",1,128),
    ("Caju", 130, "2018-02-23 17:15:20",2,125),
    ("Benji", 104, "2017-09-16 14:01:45",1,125),
    ("Benji", 104, "2017-09-16 14:01:45",2,126),
    ("Star", 106, "2017-07-05 10:01:53",1,127),
    ("Star", 106, "2017-07-05 10:01:53",2,128),
    ("Cloud", 106, "2018-07-11 12:12:49",1,125),
    ("Cloud", 106, "2018-07-11 12:12:49",2,130);


insert into radiography (name,VAT_owner,date_timestamp,num,file)
values
    ("Bella",101,"2018-02-17 13:12:20",1,"dir1"),
    ("Lucy",102,"2018-02-20 09:20:18",1,"dir2"),
    ("Kika", 101,"2017-03-02 10:14:19", 2, "dir3"),
    ("Vitória", 129,"2018-08-07 13:20:04",1,"dir4"),
    ("Caju", 130, "2018-02-23 17:15:20",1,"dir5");


insert into test_procedure(name,VAT_owner,date_timestamp,num,type)
values
    ("Lucy",102,"2018-02-20 09:20:18",2,"blood test"),
    ("Deutsch", 109, "2018-05-04 16:12:04",1,"blood test"),
    ("Kika", 101, "2017-03-02 10:14:19",1,"blood test"),
    ("Leo", 117, "2017-04-12 14:47:10", 1, "blood test"),
    ("Willy", 101, "2017-03-02 13:45:57",3,"urine test"),
    ("Kashey", 129, "2017-02-17 15:10:21",1,"blood teste"),
    ("Kashey", 129, "2017-02-17 15:10:21",2,"urine test"),
    ("Benji", 104, "2017-09-16 14:01:45",1,"blood test"),
    ("Benji", 104, "2017-09-16 14:01:45",2,"urine test"),
    ("Star", 106, "2017-07-05 10:01:53",1,"blood test"),
    ("Star", 106, "2017-07-05 10:01:53",2,"urine test"),
    ("Cloud", 106, "2018-07-11 12:12:49",1,"blood test"),
    ("Cloud", 106, "2018-07-11 12:12:49",2,"urine test");


insert into indicator (name,reference_value,unit,description)
values
    ("Glucose",102,"miligrams","65-120 for canine species, 70-120 for feline species. mg/dl of blood; for blood tests"),
    ("BUN",15,"miligrams","6-24 for canine species, 17-30 for feline species. mg/dl of blood; for blood tests"),
    ("creatinine",0.9,"miligrams","0.4-1.4 for canine species, 0.6-1.6 for feline species. mg/dl of blood; for blood tests"),
    ("total protein",6.2,"grams","5.2-7.2 for canine species, 5.3-7.2 for feline species."),
    ("cholesterol",120,"miligrams","110-314 for canine species, 90-150 for feline species. mg/dl of blood; for blood tests"),
    ("hemoglobin",13,"grams","12.1-20.3 for canine species, 9.3-15.9 for feline species. mg/dl of blood; for blood tests"),
    ("microalbumin",2.5,"miligrams","< 2.5 mg/dl of urine; for urine tests"),
    ("urine pH",6,null,"5.5-7; for urine tests"),
    ("blood pH",7.36, null,"7.32-7.34 for canine species, 7.24-7.40 for feline species; for blood tests"),
    ("WBC",2, "/hpf","white blood cells found in urine; for urine tests; /hpf means per high power field");


insert into prescription (code,name,VAT_owner,date_timestamp, name_med, lab, dosage, regime)
values
    (12, "Deutsch", 109,"2018-05-04 16:12:04","Doxilax", "Montfield Lab", "400mg", "to be taken every 6h"),
    (4, "Deutsch", 109,"2018-05-04 16:12:04","Papilem", "Montfield Lab", "200mg", "to be taken every 8h, alternative days"),
    (2, "Kika", 101, "2017-03-02 10:14:19","Loxifell", "Manhattan Lab&Co", "100mg", "to be taken whenever necessary."),
    (2, "Kika", 101, "2017-03-02 10:14:19","Catnuciti", "Manhattan Lab&Co", "100ml", "to be taken whenever necessary."),
    (2, "Kika", 101, "2017-03-02 10:14:19", "Catxim", "Manhattan Lab&Co", "50ml", "to be taken whenever necessary."),
    (15,"Vitória", 129,"2018-08-07 13:20:04","Catxim", "Manhattan Lab&Co", "50ml", "to be taken whenever necessary."),
    (3,"Kashey", 129, "2017-02-17 15:10:21","Catxim", "Manhattan Lab&Co", "50ml","to be taken every 12h"),
    (1,"Willy", 101, "2017-03-02 13:45:57","Catnuciti", "Manhattan Lab&Co", "100ml","to be yaken whenever necessary");

insert into produced_indicator(name,VAT_owner,date_timestamp,num,indicator_name,value)
values
    ("Deutsch", 109, "2018-05-04 16:12:04",1,"creatinine",1.2),
    ("Willy", 101, "2017-03-02 13:45:57",3,"total protein",5.8),
    ("Kashey", 129, "2017-02-17 15:10:21",1,"creatinine",0.8),
    ("Kashey", 129, "2017-02-17 15:10:21",2,"WBC",3),
    ("Benji", 104, "2017-09-16 14:01:45",1,"Glucose",105),
    ("Benji", 104, "2017-09-16 14:01:45",2,"urine pH",6.5),
    ("Star", 106, "2017-07-05 10:01:53",1,"cholesterol",125),
    ("Star", 106, "2017-07-05 10:01:53",1,"microalbumin",3),
    ("Cloud", 106, "2018-07-11 12:12:49",1,"creatinine",1.8),
    ("Cloud", 106, "2018-07-11 12:12:49",1,"WBC",2.5);


