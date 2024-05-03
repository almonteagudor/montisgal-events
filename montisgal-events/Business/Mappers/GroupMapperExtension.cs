using montisgal_events.Business.Dtos.Group;
using montisgal_events.Data.Entities;

namespace montisgal_events.Business.Mappers;

public static class GroupMapperExtension
{
    public static GroupDto ToDto(this GroupEntity groupEntity)
    {
        return new GroupDto()
        {
            Name = groupEntity.Name,
            Description = groupEntity.Description,
            IsPublic = groupEntity.IsPublic
        };
    }
    
    public static List<GroupDto> ToDto(this IEnumerable<GroupEntity> groupEntities)
    {
        return groupEntities.Select(ToDto).ToList();
    }
}