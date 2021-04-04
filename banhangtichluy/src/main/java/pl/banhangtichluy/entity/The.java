package pl.banhangtichluy.entity;

import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

import javax.persistence.*;

@Entity
@Table(name = "the")
@Data
@AllArgsConstructor
@NoArgsConstructor
public class The {
    @Id
    @GeneratedValue
    @Column(name = "ID", nullable = false)
    private Long id;
    @Column(name = "MASO")
    private String maSo;
    @Column(name = "LOAI")
    private String loai;
    @Column(name = "NGAYTAO")
    private String ngayTao;
    @Column(name = "NGUOITAO")
    private String nguoiTao;
    @Column(name = "DIEM")
    private String diem;
    @Column(name = "TEN")
    private String ten;
}
