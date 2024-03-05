<?php

// Dopo aver creato un nuovo database nel vostro phpMyAdmin e aver importato lo schema allegato, eseguite le query del file allegato.  

// 1. Selezionare tutti gli studenti nati nel 1990 (160)
SELECT *
FROM `students`
WHERE `date_of_birth` LIKE '1990%'
ORDER BY `enrolment_date` ASC;

// 2. Selezionare tutti i corsi che valgono più di 10 crediti (479)
SELECT *
FROM `courses`
WHERE `cfu` > "10"

// 3. Selezionare tutti gli studenti che hanno più di 30 anni

SELECT *
FROM students
WHERE TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) > 30;

// 4. Selezionare tutti i corsi del primo semestre del primo anno di un qualsiasi corso di
// laurea (286)

SELECT *
FROM `courses`
WHERE `period` = "I semestre"
AND `year` = "1";

// 5. Selezionare tutti gli appelli d'esame che avvengono nel pomeriggio (dopo le 14) del 20/06/2020 (21)

SELECT *
FROM `exams`
WHERE date = '2020-06-20'
AND hour > '14:00:00';

// 6. Selezionare tutti i corsi di laurea magistrale (38)

SELECT *
FROM `degrees`
WHERE `name` LIKE 'Corso di Laurea Magistrale%';

// 7. Da quanti dipartimenti è composta l'università? (12)

SELECT COUNT(id) AS TOTALE_DIPARTIMENTI
FROM `departments`;

// 8. Quanti sono gli insegnanti che non hanno un numero di telefono? (50)

SELECT COUNT(id) 
FROM `teachers`
WHERE `phone` IS NULL;

// 1. Contare quanti iscritti ci sono stati ogni anno

SELECT YEAR(enrolment_date) AS anno, COUNT(*) AS totale_iscritti
FROM students
GROUP BY YEAR(enrolment_date);

// 2. Contare gli insegnanti che hanno l'ufficio nello stesso edificio

SELECT `office_address` AS uffici, COUNT(*) AS totale_insegnanti
FROM teachers
GROUP BY `office_address`;

// 3. Calcolare la media dei voti di ogni appello d'esame

SELECT `exam_id`, AVG(`vote`)
FROM `exam_student`
GROUP BY `exam_id`;

// 4. Contare quanti corsi di laurea ci sono per ogni dipartimento

SELECT COUNT(*) AS `Degrees`, `department_id` 
FROM `degrees`
GROUP BY `department_id`;

/*Selezionare tutti i corsi del Corso di Laurea in Informatica*/
SELECT `courses`.`name` as `NOME DEL CORSO`, `courses`.`cfu`, `degrees`.`name`, `degrees`.`website`
FROM `courses`
JOIN `degrees`
ON `courses`.`degree_id` = `degrees`.`id`
WHERE `degrees`.`name` = 'Corso di Laurea in Informatica';

/*Selezionare le informazioni sul corso con id = 144, con tutti i relativi appelli d’esame*/

SELECT `courses`.`name`, `exams`.*
FROM `courses`
JOIN `exams`
ON `courses`.`id` = `exams`.`course_id`
WHERE `courses`.`id` = 144;

/*Selezionare tutti gli appelli d'esame del Corso di Laurea Magistrale in Fisica del
primo anno*/
 
SELECT *
FROM `degrees`
JOIN `courses`
ON `degrees`.`id` = `courses`.`degree_id`
JOIN `exams`
ON `exams`.`course_id` = `courses`.`id`
WHERE `degrees`.`name` = 'Corso di Laurea Magistrale in Fisica'
AND `courses`.`year` = 1;

/*Selezionare il libretto universitario di Mirco Messina (matricola n. 620320)*/

SELECT `students`.`name`, `students`.`surname`,`students`.`registration_number`, `exam_student`.`vote`, `exams`.`date`
FROM `students`
JOIN `exam_student`
ON `students`.`id` = `exam_student`.`student_id`
JOIN `exams`
ON `exams`.`id` = `exam_student`.`exam_id`
WHERE `students`.`name` = 'Mirco'
AND `students`.`surname` = 'Messina'
AND `exam_student`.`vote` >= 18;





// 1. Selezionare tutti gli studenti iscritti al Corso di Laurea in Economia

SELECT * 
FROM `students`
JOIN `degrees`
ON `degrees`. `id`= `students`. `degree_id`
WHERE `degrees`.`name` = 'Corso di Laurea in Economia';

// 2. Selezionare tutti i Corsi di Laurea Magistrale del Dipartimento di
// Neuroscienze

SELECT *
FROM `students`
JOIN `degrees` 
ON `degrees`.`id`= `students`.`degree_id`
JOIN `departments` 
ON `departments`.`id`= `degrees`.`department_id`
WHERE `degrees`.`level` = 'magistrale'
AND `departments`.`name` = 'Dipartimento di Neuroscienze';


// 3. Selezionare tutti i corsi in cui insegna Fulvio Amato (id=44)

SELECT *
FROM `courses`
JOIN `course_teacher` 
ON `courses`.`id` = `course_teacher`.`course_id`
JOIN `teachers` 
ON `teachers`.`id` = `course_teacher`.`teacher_id`
WHERE `teachers`.`id` = '44';


// 4. Selezionare tutti gli studenti con i dati relativi al corso di laurea a cui
// sono iscritti e il relativo dipartimento, in ordine alfabetico per cognome e
// nome

SELECT *
FROM `students`
JOIN `degrees`
ON `degrees`. `id`= `students`. `degree_id`
JOIN `departments`
ON `departments`.`id`= `degrees`.`department_id`
ORDER BY `students`.`surname`, `students`.`name`;


// 5. Selezionare tutti i corsi di laurea con i relativi corsi e insegnanti

SELECT *
FROM `courses`
JOIN `course_teacher` 
ON `courses`.`id` = `course_teacher`.`course_id`
JOIN `teachers` 
ON `teachers`.`id` = `course_teacher`.`teacher_id`
JOIN `degrees`
ON `degrees`.`id`= `courses`. `degree_id`

// 6. Selezionare tutti i docenti che insegnano nel Dipartimento di
// Matematica (54)

SELECT `teachers`.`name`, `teachers`.`surname`, `departments`.`name`
FROM `courses`
JOIN `course_teacher` 
ON `courses`.`id` = `course_teacher`.`course_id`
JOIN `teachers` 
ON `teachers`.`id` = `course_teacher`.`teacher_id`
JOIN `degrees` 
ON `degrees`.`id`= `courses`.`degree_id`
JOIN `departments` 
ON `departments`.`id`= `degrees`.`department_id`
WHERE `departments`.`name` = 'Dipartimento di Matematica';

// 7. BONUS: Selezionare per ogni studente il numero di tentativi sostenuti
// per ogni esame, stampando anche il voto massimo. Successivamente,
// filtrare i tentativi con voto minimo 18.
