package pl.banhangtichluy.entity;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.*;

import javax.persistence.*;

@Entity
@Table(name = "role_permission")
@Getter
@Setter
@NoArgsConstructor
@AllArgsConstructor
public class RolePermission extends BaseEntity{

    @ManyToOne(fetch = FetchType.LAZY)
    @JoinColumn(name = "role_id")
    @EqualsAndHashCode.Exclude
    @ToString.Exclude
    @JsonIgnoreProperties(Role_.ROLE_PERMISSIONS)
    @JsonProperty("role")
    private Role role;

    @ManyToOne(fetch = FetchType.LAZY)
    @JoinColumn(name = "permission_id")
    @EqualsAndHashCode.Exclude
    @ToString.Exclude
    @JsonIgnoreProperties(Permission_.ROLE_PERMISSIONS)
    @JsonProperty("permission")
    private Permission permission;

}
