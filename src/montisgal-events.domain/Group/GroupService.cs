using montisgal_events.domain.Group.ValueObjects;

namespace montisgal_events.domain.Group;

public static class GroupService
{
    public static Group CreateNewGroup(string name, string? description, bool visibility, Guid ownerId)
    {
        var groupName = new GroupName(name);
        var groupDescription = new GroupDescription(description);
        var groupVisibility = new GroupVisibility(visibility);

        return new Group(Guid.NewGuid(), groupName, groupDescription, groupVisibility, ownerId);
    }
    
    public static Group CreateExistingGroup(Guid id, string name, string? description, bool visibility, Guid ownerId)
    {
        var groupName = new GroupName(name);
        var groupDescription = new GroupDescription(description);
        var groupVisibility = new GroupVisibility(visibility);

        return new Group(id, groupName, groupDescription, groupVisibility, ownerId);
    }
    
    public static Group UpdateGroup(Group group, string name, string description, bool visibility)
    {
        var groupName = new GroupName(name);
        var groupDescription = new GroupDescription(description);
        var groupVisibility = new GroupVisibility(visibility);

        group.Name = groupName;
        group.Description = groupDescription;
        group.GroupVisibility = groupVisibility;

        return group;
    }
}