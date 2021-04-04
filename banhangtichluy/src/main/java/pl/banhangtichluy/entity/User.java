package pl.banhangtichluy.entity;

import com.fasterxml.jackson.annotation.JsonIgnore;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.AllArgsConstructor;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.Setter;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Table;

@Entity
@Table(name = "users")
@Getter
@Setter
@NoArgsConstructor
@AllArgsConstructor
public class User extends BaseEntity{

    @Column(name = "username")
    private String username;
    @Column(name = "password")
    @JsonIgnore
    private String password;
    @JsonProperty(value = "first_name")
    @Column(name = "first_name")
    private String firstName;
    @Column(name = "last_name")
    private String lastName;
    @JsonProperty(value = "last_name")
    @Column(name = "email")
    private String email;
    @Column(name = "phone")
    private String phone;

}
