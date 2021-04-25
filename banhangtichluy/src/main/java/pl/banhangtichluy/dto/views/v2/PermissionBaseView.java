package pl.banhangtichluy.dto.views.v2;

import com.querydsl.core.Tuple;
import com.querydsl.core.types.MappingProjection;
import io.swagger.annotations.ApiModel;
import io.swagger.annotations.ApiModelProperty;
import lombok.Data;
import lombok.NoArgsConstructor;
import lombok.experimental.SuperBuilder;
import pl.banhangtichluy.constants.EntityPropsDescriptionConstant;
import pl.banhangtichluy.entity.QPermission;

@Data
@SuperBuilder
@NoArgsConstructor
@ApiModel(value = "PermissionBaseView", description = "Basic information of permission")
public class PermissionBaseView {

    @ApiModelProperty(name = "id", notes = EntityPropsDescriptionConstant.PermissionProps.ID, example = "100")
    private Long id;

    @ApiModelProperty(name = "name", notes = EntityPropsDescriptionConstant.PermissionProps.NAME, example = "STAFF")
    private String name;

    private static final QPermission permission = QPermission.permission;

    public static final MappingProjection<PermissionBaseView> PROJECTIONS = new MappingProjection<PermissionBaseView>(
            PermissionBaseView.class,
            permission.id, permission.name
    ) {
        @Override
        protected PermissionBaseView map(Tuple row) {
            return PermissionBaseView.builder()
                    .id(row.get(permission.id))
                    .name(row.get(permission.name))
                    .build();
        }
    };
}
