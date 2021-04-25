package pl.banhangtichluy.dto.views.v2;

import com.querydsl.core.Tuple;
import com.querydsl.core.types.MappingProjection;
import io.swagger.annotations.ApiModel;
import io.swagger.annotations.ApiModelProperty;
import lombok.Data;
import lombok.NoArgsConstructor;
import lombok.experimental.SuperBuilder;
import pl.banhangtichluy.constants.EntityPropsDescriptionConstant;
import pl.banhangtichluy.entity.QAmount;
import pl.banhangtichluy.entity.QRole;

@Data
@SuperBuilder
@NoArgsConstructor
@ApiModel(value = "RoleBaseView", description = "Basic information of role")
public class RoleBaseView {

    @ApiModelProperty(name = "id", notes = EntityPropsDescriptionConstant.RoleProps.ID, example = "100")
    private Long id;

    @ApiModelProperty(name = "name", notes = EntityPropsDescriptionConstant.RoleProps.NAME, example = "STAFF")
    private String name;

    private static final QRole role = QRole.role;

    public static final MappingProjection<RoleBaseView> PROJECTIONS = new MappingProjection<RoleBaseView>(
            RoleBaseView.class,
            role.id, role.name
    ) {
        @Override
        protected RoleBaseView map(Tuple row) {
            return RoleBaseView.builder()
                    .id(row.get(role.id))
                    .name(row.get(role.name))
                    .build();
        }
    };
}
