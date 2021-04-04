package pl.banhangtichluy.entity;

import lombok.Data;

import javax.persistence.*;
import java.sql.Date;

@Entity
@Table(name = "diem")
@Data
public class Diem {
    @Id
    @GeneratedValue
    @Column(name = "ID", nullable = false)
    private Long id;
    @Column(name = "LOAITHE")
    private Long loaiThe;
    @Column(name = "DIEM")
    private Long diem;
    @Column(name = "NGUOICAPNHAT")
    private String nguoiCapNhat;
    @Column(name = "NGAYCAPNHAT")
    private Date ngayCapNhat;
}
