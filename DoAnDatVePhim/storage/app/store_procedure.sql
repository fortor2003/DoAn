create or replace PROCEDURE SP__TAOQUANHE_PHIMTHELOAI (O_ERROR OUT NUMBER , O_MESSAGE OUT VARCHAR2 )
AS
    v_cur SYS_REFCURSOR;
    v_phimId number;
    v_theLoaiExternalId VARCHAR2(200);
BEGIN
    open v_cur for select id, the_loai_external_id
    from phim
    where the_loai_external_id is not null and the_loai_external_id != '[]';
    -- Lặp qua từng phim
    loop
        FETCH v_cur INTO v_phimId, v_theLoaiExternalId;
        EXIT WHEN v_cur%NOTFOUND;
        -- Xóa tất cả các quan hệ phim_the_loai của phim này
        delete from phim_the_loai where phim_id = v_phimId;
        -- Tạo quan hệ mới
        insert into phim_the_loai(phim_id, the_loai_id, thoi_diem_tao, thoi_diem_cap_nhat)
        select v_phimId, tl.id, sysdate, sysdate
        from json_table(v_theLoaiExternalId, '$[*]' columns (the_loai_external_id number path '$')) jt
        inner join the_loai tl on jt.the_loai_external_id = tl.external_id;
    end loop;
    -- Thông báo hoàn tất
    o_error := 0;
END SP__TAOQUANHE_PHIMTHELOAI;
