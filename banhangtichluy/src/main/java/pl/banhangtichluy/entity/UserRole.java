package pl.banhangtichluy.entity;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.*;

import javax.persistence.*;

@Entity
@Table(name = "user_role")
@Getter
@Setter
@NoArgsConstructor
@AllArgsConstructor
public class UserRole extends BaseEntity{

    @ManyToOne(fetch = FetchType.LAZY)
    @JoinColumn(name = "user_id")
    @EqualsAndHashCode.Exclude
    @ToString.Exclude
    @JsonIgnoreProperties("userRoles")
    @JsonProperty("user")
    private User user;

    @ManyToOne(fetch = FetchType.LAZY)
    @JoinColumn(name = "role_id")
    @EqualsAndHashCode.Exclude
    @ToString.Exclude
    @JsonIgnoreProperties("userRoles")
    @JsonProperty("role")
    private Role role;

}
