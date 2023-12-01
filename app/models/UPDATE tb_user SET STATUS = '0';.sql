UPDATE tb_user
SET STATUS = '0';
UPDATE tb_mitra
set lecture = 1,
    STATUS = '0';
INSERT INTO tb_request_magang (user_id, mitra_id, request_status)
VALUES (9, 5, 'accepted');
DELETE from tb_magang