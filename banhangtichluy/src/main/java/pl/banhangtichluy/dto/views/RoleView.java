package pl.banhangtichluy.dto.views;

import com.querydsl.core.Tuple;
import com.querydsl.core.types.MappingProjection;
import io.swagger.annotations.ApiModel;
import io.swagger.annotations.ApiModelProperty;
import lombok.Data;
import lombok.EqualsAndHashCode;
import lombok.NoArgsConstructor;
import lombok.experimental.SuperBuilder;
import pl.banhangtichluy.constants.EntityPropsDescriptionConstant;
import pl.banhangtichluy.entity.QRole;

import java.util.Date;

@Data
@SuperBuilder
@NoArgsConstructor
@EqualsAndHashCode(callSuper = true)
@ApiModel(value = "RoleView", description = "Detailed information of role")
public class RoleView extends RoleBaseView {

    @ApiModelProperty(name = "note", notes = EntityPropsDescriptionConstant.RoleProps.NOTE, example = "Example note")
    private String note;

    @ApiModelProperty(name = "createdAt", notes = EntityPropsDescriptionConstant.RoleProps.CREATED_AT, example = "2020-08-13 14:30:00")
    private Date createdAt;

    @ApiModelProperty(name = "updatedAt", notes = EntityPropsDescriptionConstant.RoleProps.UPDATED_AT, example = "2020-10-20 08:10:50")
    private Date updatedAt;

    private static final QRole role = QRole.role;

    public static final MappingProjection<RoleView> PROJECTIONS = new MappingProjection<RoleView>(
            RoleBaseView.class,
            role.id, role.name,
            role.note, role.createdAt, role.updatedAt
    ) {
        @Override
        protected RoleView map(Tuple row) {
            return RoleView.builder()
                    .id(row.get(role.id))
                    .name(row.get(role.name))
                    .note(row.get(role.note))
                    .createdAt(row.get(role.createdAt))
                    .updatedAt(row.get(role.updatedAt))
                    .build();
        }
    };
}
