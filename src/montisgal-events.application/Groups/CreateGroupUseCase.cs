using montisgal_events.domain.Group;

namespace montisgal_events.application.Groups;

public class CreateGroupUseCase(IGroupRepository repository)
{
    public async Task<Group?> Execute(string name, string description, bool isPublic, Guid ownerId)
    {
        var group = GroupService.CreateNewGroup(name, description, isPublic, ownerId);

        return await repository.InsertGroup(group);
    }
}