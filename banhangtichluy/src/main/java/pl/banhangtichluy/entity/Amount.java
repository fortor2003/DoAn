package pl.banhangtichluy.entity;

import com.fasterxml.jackson.annotation.JsonIgnore;
import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.*;
import lombok.experimental.SuperBuilder;
import org.hibernate.annotations.Fetch;
import org.hibernate.annotations.FetchMode;
import pl.banhangtichluy.enums.AmountType;

import javax.persistence.*;
import java.util.List;

@Entity
@Table(name = "amounts")
@Getter
@Setter
@NoArgsConstructor
@AllArgsConstructor
public class Amount extends BaseEntity{

    @Column(name = "type")
    @JsonProperty("type")
    private String type;

    @Column(name = "code")
    @JsonProperty("code")
    private String code;

    @Column(name = "value")
    @JsonProperty("value")
    private Integer value;

    @Column(name = "firstName")
    @JsonProperty("firstName")
    private String firstName;

    @Column(name = "lastName")
    @JsonProperty("lastName")
    private String lastName;

    @Column(name = "email")
    @JsonProperty("email")
    private String email;

    @Column(name = "phone")
    @JsonProperty("phone")
    private String phone;

    @ManyToOne(fetch = FetchType.LAZY)
    @JoinColumn(name = "created_by")
    @EqualsAndHashCode.Exclude
    @ToString.Exclude
    @JsonIgnoreProperties(User_.CREATED_AMOUNTS)
    @JsonProperty("createdBy")
    private User createdBy;

    @ManyToOne(fetch = FetchType.LAZY)
    @JoinColumn(name = "updated_by")
    @EqualsAndHashCode.Exclude
    @ToString.Exclude
    @JsonIgnoreProperties(User_.UPDATED_AMOUNTS)
    @JsonProperty("updatedBy")
    private User updatedBy;

    @OneToMany(mappedBy = Transaction_.AMOUNT, fetch = FetchType.LAZY)
    @JsonProperty("transactions")
    private List<Transaction> transactions;

}
