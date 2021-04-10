package pl.banhangtichluy.entity;

import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.AllArgsConstructor;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.Setter;

import javax.persistence.*;
import java.util.List;

@Entity
@Table(name = "roles")
@Getter
@Setter
@NoArgsConstructor
@AllArgsConstructor
public class Role extends BaseEntity{

    @Column(name = "name")
    @JsonProperty("name")
    private String name;

    @OneToMany(mappedBy = UserRole_.ROLE, fetch = FetchType.LAZY)
    @JsonProperty("userRoles")
    private List<UserRole> userRoles;

    @OneToMany(mappedBy = RolePermission_.ROLE, fetch = FetchType.LAZY)
    @JsonProperty("rolePermissions")
    private List<RolePermission> rolePermissions;

}
