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
FROM `students`
WHERE `date_of_birth` < "2006-03-04"

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