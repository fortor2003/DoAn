package pl.banhangtichluy.entity;

import lombok.Data;

import javax.persistence.*;
import java.sql.Date;

@Entity
@Table(name = "lichsu")
@Data
public class LichSu {
    @Id
    @GeneratedValue
    @Column(name = "ID", nullable = false)
    private Long id;
    @ManyToOne(fetch = FetchType.LAZY)
    @JoinColumn(name = "IDTHE", referencedColumnName = "ID")
    private The The;
    @Column(name = "SODUBANDAU")
    private Long soDuBanDau;
    @Column(name = "SOTRU")
    private Long soTru;
    @Column(name = "SODUCONLAI")
    private Long soDuConLai;
    @Column(name = "NGUOITHUCHIEN")
    private String nguoiThucHien;
    @Column(name = "THOIGIANGTHUCHIEN")
    private Date thoiGiangThucHien;
    @Column(name = "GHICHU")
    private String ghiChu;
    @Column(name = "TINHTRANG")
    private String tinhTrang;
}
