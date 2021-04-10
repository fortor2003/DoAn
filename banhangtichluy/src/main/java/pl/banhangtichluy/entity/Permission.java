package pl.banhangtichluy.entity;

import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.AllArgsConstructor;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.Setter;

import javax.persistence.*;
import java.util.List;

@Entity
@Table(name = "permissions")
@Getter
@Setter
@NoArgsConstructor
@AllArgsConstructor
public class Permission extends BaseEntity{

    @Column(name = "name")
    @JsonProperty("name")
    private String name;

    @OneToMany(mappedBy = RolePermission_.PERMISSION, fetch = FetchType.LAZY)
    @JsonProperty("rolePermissions")
    private List<RolePermission> rolePermissions;

}
