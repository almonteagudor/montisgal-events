using montisgal_events.domain.Groups;
using montisgal_events.mvc.Data.Entities;

namespace montisgal_events.mvc.Mappers;

public static class GroupMapperExtension
{
    public static Group ToDomainEntity(this GroupEntity groupEntity)
    {
        return new Group(
            groupEntity.Id,
            groupEntity.Name,
            groupEntity.Description,
            groupEntity.IsPublic,
            Guid.Parse(groupEntity.OwnerId)
        );
    }

    public static List<Group> ToDomainEntity(this IEnumerable<GroupEntity> groupEntities)
    {
        return groupEntities.Select(ToDomainEntity).ToList();
    }

    public static GroupEntity ToEntity(this Group group)
    {
        return new GroupEntity(
            group.Id,
            group.Name,
            group.Description,
            group.IsPublic,
            group.OwnerId.ToString()
        );
    }

    public static List<GroupEntity> ToEntity(this IEnumerable<Group> groups)
    {
        return groups.Select(ToEntity).ToList();
    }
}