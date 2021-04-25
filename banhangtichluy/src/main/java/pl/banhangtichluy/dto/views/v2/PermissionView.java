package pl.banhangtichluy.dto.views.v2;

import com.querydsl.core.Tuple;
import com.querydsl.core.types.MappingProjection;
import io.swagger.annotations.ApiModel;
import io.swagger.annotations.ApiModelProperty;
import lombok.Data;
import lombok.EqualsAndHashCode;
import lombok.NoArgsConstructor;
import lombok.experimental.SuperBuilder;
import pl.banhangtichluy.constants.EntityPropsDescriptionConstant;
import pl.banhangtichluy.entity.QPermission;

import java.util.Date;

@Data
@SuperBuilder
@NoArgsConstructor
@EqualsAndHashCode(callSuper = true)
@ApiModel(value = "PermissionView", description = "Detailed information of permission")
public class PermissionView extends PermissionBaseView {

    @ApiModelProperty(name = "note", notes = EntityPropsDescriptionConstant.PermissionProps.NOTE, example = "Example note")
    private String note;

    @ApiModelProperty(name = "createdAt", notes = EntityPropsDescriptionConstant.PermissionProps.CREATED_AT, example = "2020-08-13 14:30:00")
    private Date createdAt;

    @ApiModelProperty(name = "updatedAt", notes = EntityPropsDescriptionConstant.PermissionProps.UPDATED_AT, example = "2020-10-20 08:10:50")
    private Date updatedAt;

    private static final QPermission permission = QPermission.permission;

    public static final MappingProjection<PermissionView> PROJECTIONS = new MappingProjection<PermissionView>(
            PermissionBaseView.class,
            permission.id, permission.name,
            permission.note, permission.createdAt, permission.updatedAt
    ) {
        @Override
        protected PermissionView map(Tuple row) {
            return PermissionView.builder()
                    .id(row.get(permission.id))
                    .name(row.get(permission.name))
                    .note(row.get(permission.note))
                    .createdAt(row.get(permission.createdAt))
                    .updatedAt(row.get(permission.updatedAt))
                    .build();
        }
    };
}
