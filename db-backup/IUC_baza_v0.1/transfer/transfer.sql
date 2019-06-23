INSERT INTO iuc_new.continent (id,name) SELECT id, name FROM iuc_old.continent;

INSERT INTO iuc_new.region (id,name) SELECT id, name FROM iuc_old.region;

INSERT INTO iuc_new.country (id, name, continentId, regionId) SELECT c.id, c.name, c.continentId, rc.regionId FROM iuc_old.country c JOIN iuc_old.region_country rc ON rc.countryId = c.id;

INSERT INTO iuc_new.city (name, countryId) SELECT mi.city, c.id FROM iuc_old.member_inst mi JOIN iuc_old.country c ON c.name = mi.country;

INSERT INTO cycle (id, title, aktivan, year_start, year_end, vidljiv)  SELECT id, title,active_new, year_start, year_end, visible_new FROM iuc_old.cycle;

INSERT INTO iuc_new.institutes_list (id, countryId, name) SELECT id, countryId, name FROM iuc_old.institute;

INSERT INTO iuc_new.institute (id, name, cityId, webAddress, isMember, address, president, iucRepresentative, financeContact, internationalContact, memberFrom, memberTo, comment)
SELECT i.id, i.name, c.id, i.webAddress, i.isMember, i.address,i.president, i.iucRep, i.financeContact, i.internationalContact, i.memberFrom, i.withdrawl, i.other FROM iuc_old.member_inst i
JOIN iuc_new.city c ON c.name = i.city;

INSERT INTO iuc_new.person (id, firstname, lastname, instituteId, address, phone, mobile, fax, email, url, academicStatus, department, countryId)
SELECT id, firstname,lastname,instituteId, address, phone,mobile,fax,email,url,academicStatus,department,countryId FROM iuc_old.person;



INSERT INTO iuc_new.role (id, title) SELECT id, description FROM iuc_old.roletype;

INSERT INTO iuc_new.eventtype (name) VALUE ('conference'), ('course');

INSERT INTO iuc_new.eventt (typeId, cycleId, eventnum, title, description, notice, start_date, end_date, mystatus, subtitle, lang_en, lang_de, lang_fr, workschedule, second_cycleId, gcf, paidAmount,paidCurrencyId,isWaiver,participationFee,numUnregParticipants)
SELECT 1, cycleId, confnum,title,description,notice,start_date,end_date, mystatus, subtitle, lang_en, lang_de, lang_fr, workschedule, second_cycleId, gcf, paidAmmount, paidValuteId, isWaiver, participationFee,numUnregParticipants FROM iuc_old.conference;

INSERT INTO iuc_new.eventt (typeId, cycleId, eventnum, title, description, notice, start_date, end_date, mystatus, subtitle, lang_en, lang_de, lang_fr, workschedule, second_cycleId, gcf, paidAmount,paidCurrencyId,isWaiver,participationFee,numUnregParticipants)
SELECT  2, cycleId, coursenum,title,description,notice,start_date,end_date, mystatus, subtitle, lang_en, lang_de, lang_fr, workschedule, second_cycleId, gcf, paidAmmount, paidValuteId, isWaiver, participationFee,numUnregParticipants FROM iuc_old.course;

INSERT INTO iuc_new.scholarship (id, name) SELECT id, name FROM iuc_old.scholarship;

INSERT INTO member_payment (instituteId, year, paidAmount, currencyId) SELECT memberId, year, paidAmmount, paidValuteId FROM iuc_old.member_payment;

INSERT INTO govern_person (title, memberFrom, memberTo, isActive, instituteName, other, fullname, webpage, email) SELECT title, memberFrom, resignedFrom,isActive,institute, other, fullname, webpage, email FROM iuc_old.govern;

--
INSERT INTO iuc_new.person_event_role (personId, eventId, roleId, scholarshipId, paidAmount, paidCurrencyId) SELECT personId, new_refcourses, typeId, scholarshipId, paidAmmount, paidValuteId FROM iuc_old.iucrole where new_refcourses IS NOT NULL;
--
INSERT INTO iuc_new.person_event_role (personId, eventId, roleId, scholarshipId, paidAmount, paidCurrencyId) SELECT personId, new_refconf, typeId, scholarshipId, paidAmmount, paidValuteId FROM iuc_old.iucrole where new_refconf IS NOT NULL;
--
--
--
INSERT INTO iuc_new.news(id, title, summary, body, date) SELECT id, title, summary, htmltext, datum FROM iuc_old.news;
