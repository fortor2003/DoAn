package pl.banhangtichluy.entity;

import com.fasterxml.jackson.annotation.JsonIgnore;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.AllArgsConstructor;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.Setter;
import pl.banhangtichluy.annotaions.ValidateEnum;
import pl.banhangtichluy.enums.AmountType;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Table;
import javax.validation.constraints.Email;
import javax.validation.constraints.Min;
import javax.validation.constraints.NotBlank;
import javax.validation.constraints.NotNull;

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

    @Column(name = "note")
    @JsonProperty("note")
    private String note;

    @Column(name = "created_by")
    @JsonProperty("createdBy")
    private Long createdBy;

    @Column(name = "updated_by")
    @JsonProperty("updatedBy")
    private Long updatedBy;

}
